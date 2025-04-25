<?php

namespace App\Controllers;

use App\Models\User;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;
use App\Middleware\Authenticate;
use App\Middleware\AuthorizeAdmin;

class UsersController extends Controller
{
    public function __construct()
    {
        $request = new \Core\Http\Request();
        (new Authenticate())->handle($request);
        (new AuthorizeAdmin())->handle($request);
    }

    public function index(Request $request): void
    {
        $paginator = User::paginate(page: $request->getParam('page', 1));
        $users = $paginator->registers();

        if ($request->acceptJson()) {
            $this->renderJson('users/index', compact('paginator', 'users'));
        } else {
            $this->render('users/index', compact('paginator', 'users'));
        }
    }

    public function show(Request $request): void
    {
        $params = $request->getParams();

        $user = User::findById($params['id']);

        if (!$user) {
            $this->redirectBack();
            return;
        }

        $this->render('users/show', compact('user'));
    }

    public function new(): void
    {
        $user = new User();

        $this->render('users/new', compact('user'));
    }

    public function create(Request $request): void
    {
        $params = $request->getParams();
        $user = new User($params['user']);

        if ($user->validates()) {
            FlashMessage::danger('Existem dados incorretos! Por favor, verificar!');
            $this->render('users/new', compact('user'));
            return;
        }

        if ($user->save()) {
            FlashMessage::success('Usuário registrado com sucesso!');
            $this->redirectTo(route('users.index'));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por favor verifique!');
            $this->render('users/new', compact('user'));
        }
    }

    public function edit(Request $request): void
    {
        $params = $request->getParams();
        $user = User::findById($params['id']);

        $this->render('users/edit', compact('user'));
    }

    public function update(Request $request): void
    {
        $id = $request->getParam('id');
        $params = $request->getParam('user');

        $user = User::findById($id);

        $user->name = $params['name'] ?? $user->name;
        $user->email = $params['email'] ?? $user->email;
        $user->role = $params['role'] ?? $user->role;
        $user->password = $params['password'] ?? $user->password;

        if ($user->save()) {
            FlashMessage::success('Usuário atualizado com sucesso!');
            $this->redirectTo(route('users.index'));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por verifique!');
            $this->render('users/edit', compact('user'));
        }
    }

    public function destroy(Request $request): void
    {
        $params = $request->getParams();

        $user = User::findById($params['id']);
        $user->destroy();

        FlashMessage::success('Usuário removido com sucesso!');
        $this->redirectTo(route('users.index'));
    }
}
