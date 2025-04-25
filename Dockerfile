FROM php:8.3.4-fpm

# Instale extensões PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Instale o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instale o Nginx
RUN apt-get update && apt-get install -y nginx && rm -rf /var/lib/apt/lists/*

# Defina diretório de trabalho
WORKDIR /var/www

# Copie o código do projeto
COPY . .

# Copie a configuração customizada do nginx
COPY ./server/nginx.conf /etc/nginx/conf.d/default.conf

# Instale as dependências PHP
RUN composer install --no-dev --optimize-autoloader || true

# Crie diretório de logs do nginx
RUN mkdir -p /var/www/log/nginx

# Exponha a porta 8080 (App Platform espera essa porta)
EXPOSE 8080

# Script de entrada para rodar Nginx e PHP-FPM juntos corretamente
CMD ["sh", "-c", "php-fpm -y /usr/local/etc/php-fpm.conf -R & nginx -g 'daemon off;'"]