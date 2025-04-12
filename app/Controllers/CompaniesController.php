<?php

namespace App\Controllers;

use App\Models\Company;
use App\Models\Associate;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;

class CompaniesController extends Controller
{
  public function index(Request $request): void
  {
    $companies = Company::all();

    if ($request->acceptJson()) {
      $this->renderJson('companies/index', compact('companies'));
    } else {
      $this->render('companies/index', compact('companies'));
    }
  }

  public function show(Request $request): void
  {
    $params = $request->getParams();

    if ($params['id'] === 'new') {
      $this->new($request);
      return;
    }

    // Converte o id para inteiro
    $id = (int) $params['id'];
    $company = Company::findById($id);

    if (!$company) {
      $this->redirectBack();
      return;
    }

    $this->render('companies/show', compact('company'));
  }

  public function new(Request $request): void
  {
    $company = new Company();

    $this->render('companies/new', compact('company'));
  }

  public function create(Request $request): void
  {
    $params = $request->getParams();
    $company = new Company($params['company']);

    if ($company->validates()) {
      FlashMessage::danger('Existem dados incorretos! Por favor, verificar!');
      $this->render('companies/new', compact('company'));
      return;
    }

    if ($company->save()) {
      FlashMessage::success('Empresa registrada com sucesso!');
      $this->redirectTo(route('companies.index'));
    } else {
      FlashMessage::danger('Existem dados incorretos! Por favor verifique!');
      $this->render('companies/new', compact('company'));
    }
  }
}
