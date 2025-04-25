<?php

namespace App\Controllers;

use App\Models\Company;
use App\Models\Associate;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;
use App\Middleware\Authenticate;

class AssociatesController extends Controller
{
    public function __construct()
    {
        $request = new \Core\Http\Request();
        (new Authenticate())->handle($request);
    }

    public function index(Request $request): void
    {
        $companyId = $request->getParam('company_id');
        $company = Company::findById($companyId);

        $associates = $company->associates;

        if ($request->acceptJson()) {
            $this->renderJson('associates/index', compact('associates', 'company'));
        } else {
            $this->render('associates/index', compact('associates', 'company'));
        }
    }

    public function new(Request $request): void
    {
        $companyId = $request->getParam('company_id');
        $associate = new Associate();

        $this->render('associates/new', compact('associate', 'companyId'));
    }

    public function create(Request $request): void
    {
        $params = $request->getParams();
        $associate = new Associate($params['associate']);
        $companyId = $params['associate']['company_id'];

        if ($associate->validates()) {
            FlashMessage::danger('Existem dados incorretos! Por favor, verificar!');
            $this->render('associates/new', compact('associate', 'companyId'));
            return;
        }

        if ($associate->save()) {
            FlashMessage::success('Sócio adicionado com sucesso!');
            $this->redirectTo(route('associates.index', ['company_id' => $companyId]));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por favor verifique!');
            $this->render('associates/new', compact('associate', 'companyId'));
        }
    }

    public function destroy(Request $request): void
    {
        $params = $request->getParams();

        $associate = Associate::findById($params['id']);
        if ($associate) {
            $companyId = $associate->company_id;
            $associate->destroy();
        }

        FlashMessage::success('Sócio removido com sucesso!');
        $this->redirectTo(route('associates.index', ['company_id' => $companyId]));
    }
}
