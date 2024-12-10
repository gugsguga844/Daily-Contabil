<?php

namespace App\Controllers;

use App\Models\User;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;

class UsersController extends Controller
{
    public function index(Request $request): void
    {
        $paginator = User::paginate(page: $request->getParam('page', 1));
        $users = $paginator->registers();

        $title = 'Usuários Cadastrados';

        if ($request->acceptJson()) {
            $this->renderJson('users/index', compact('users', 'title'));
        } else {
            $this->render('users/index', compact('users', 'title'));
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

        $title = "Visualização do Problema #{$user->id}";
        $this->render('users/show', compact('user', 'title'));
    }

    public function new(): void
    {
        $user = new User();

        $title = 'Novo Usuário';
        $this->render('users/new', compact('user', 'title'));
    }

    public function create(Request $request): void
    {
        $params = $request->getParams();
        $user = new User($params['user']);
        $user->validates();

        if ($user->hasErrors()) {
            FlashMessage::danger('Existem dados incorretos! Por favor, verifique!');
            $title = 'Novo Usuário';
            $this->render('users/new', compact('user', 'title'));
            return;
        }

        if ($user->save()) {
            FlashMessage::success('Problema registrado com sucesso!');
            $this->redirectTo(route('users.index'));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por verifique!');
            $title = 'Novo Usuário';
            $this->render('users/new', compact('user', 'title'));
        }

        echo "Chegou até aqui!";
        var_dump($user->errors);
        exit;
    }

//     public function edit(Request $request): void
//     {
//         $params = $request->getParams();
//         $problem = $this->current_user->users()->findById($params['id']);

//         $title = "Editar Problema #{$problem->id}";
//         $this->render('problems/edit', compact('problem', 'title'));
//     }

//     public function update(Request $request): void
//     {
//         $id = $request->getParam('id');
//         $params = $request->getParam('problem');

//         $problem = $this->current_user->users()->findById($id);
//         $problem->title = $params['title'];

//         if ($problem->save()) {
//             FlashMessage::success('Problema atualizado com sucesso!');
//             $this->redirectTo(route('problems.index'));
//         } else {
//             FlashMessage::danger('Existem dados incorretos! Por verifique!');
//             $title = "Editar Problema #{$problem->id}";
//             $this->render('problems/edit', compact('problem', 'title'));
//         }
//     }

//     public function destroy(Request $request): void
//     {
//         $params = $request->getParams();

//         $problem = $this->current_user->users()->findById($params['id']);
//         $problem->destroy();

//         FlashMessage::success('Problema removido com sucesso!');
//         $this->redirectTo(route('problems.index'));
//     }
}