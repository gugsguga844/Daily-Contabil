<?php

namespace App\Middleware;

use Core\Http\Request;
use Lib\Security\Csrf;

class VerifyCsrfToken implements \Core\Http\Middleware\Middleware
{
    public function handle(Request $request): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            if (!Csrf::validateToken($token)) {
                // Token inválido: bloqueie a requisição!
                http_response_code(419);
                die('CSRF token inválido!');
            }
        }
    }
}
