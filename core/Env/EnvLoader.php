<?php

namespace Core\Env;

use Core\Constants\Constants;

class EnvLoader
{
    public static function init(): void
    {
        $envPath = Constants::rootPath()->join('.env');
        if (file_exists($envPath)) {
            $envs = parse_ini_file($envPath);
            foreach ($envs as $key => $value) {
                // Só define se não existir no ambiente
                if (getenv($key) === false) {
                    putenv("$key=$value");
                    $_ENV[$key] = $value;
                }
            }
        }
        // Em produção, as variáveis já estarão presentes no ambiente
    }
}
