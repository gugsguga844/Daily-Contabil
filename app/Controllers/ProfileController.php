<?php

namespace App\Controllers;

use App\Models\User;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class ProfileController extends Controller
{
    public function show(): void
    {
        $this->render('profile/show');
    }

    public function updateAvatar(): void
    {
        $user = Auth::user();

        $image = $_FILES['user_avatar'];

        $allowed = array("image/jpeg", "image/jpg", "image/png");
        if (!in_array($image['type'], $allowed)) {
            FlashMessage::danger('Erro: Formato não suportado');
            $this->redirectTo(route('profile.show'));
        }
        if ($image['size'] > 2 * 1020 * 1020) {
            FlashMessage::danger('Erro: imagem maior que o tamanho permitido de 2.048kb');
            $this->redirectTo(route('profile.show'));
        }

        $user->avatar()->update($image);
        $this->redirectTo(route('profile.show'));
    }

    public function removeAvatar(): void
    {
        $user = Auth::user();

        $user->avatar()->remove();
        $this->redirectTo(route('profile.show'));
    }
}
