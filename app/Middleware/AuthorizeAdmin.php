<?php

namespace App\Middleware;

use Core\Http\Middleware\Middleware;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class AuthorizeAdmin implements Middleware
{
    public function handle(Request $request): void
    {
        // Verifique se o usuário está logado
        if (!Auth::check()) {
            FlashMessage::danger('Você deve estar logado para acessar essa página');
            $this->redirectTo(route('users.login'));
        }

        // Verifique se o usuário é admin
        if (Auth::user()->role !== 'admin') {
            FlashMessage::danger('Você não tem permissão para acessar esta página');
            $this->redirectTo(route('home.index'));
        }
    }

    private function redirectTo(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }
}