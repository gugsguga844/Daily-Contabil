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
    $pdo = \Core\Database\Database::getDatabaseConn();
    $attributes = implode(', ', Company::columns());
    $sql = <<<SQL
        SELECT id, {$attributes} 
        FROM companies 
        ORDER BY name ASC
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    $companies = [];
    foreach ($rows as $row) {
        $companies[] = new Company($row);
    }

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
    $associates = Associate::all();

    $this->render('companies/new', compact('company', 'associates'));
  }

  public function create(Request $request): void
  {
    $params = $request->getParams();
    $company = new Company($params['company']);

    if ($company->save()) {
      // Processar sócios se existirem
      if (isset($params['associates'])) {
        $associates = $params['associates'];
        $associateCount = count($associates['name']);

        for ($i = 0; $i < $associateCount; $i++) {
          $associateData = [
            'name' => $associates['name'][$i],
            'cpf' => $associates['cpf'][$i],
            'participation' => $associates['participation'][$i],
            'qualification' => $associates['qualification'][$i],
            'phone' => $associates['phone'][$i],
            'email' => $associates['email'][$i],
            'company_id' => $company->id
          ];

          $associate = new Associate($associateData);
          $associate->save();
        }
      }

      FlashMessage::success('Empresa registrada com sucesso!');
      $this->redirectTo(route('companies.index'));
    } else {
      FlashMessage::danger('Existem dados incorretos! Por favor verifique!');
      $this->render('companies/new', compact('company'));
    }
  }

  public function edit(Request $request): void
  {
    $params = $request->getParams();
    $company = Company::findById($params['id']);

    $this->render('companies/edit', compact('company'));
  }

  public function update(Request $request): void
  {
    $id = $request->getParam('id');
    $params = $request->getParam('company');

    $company = Company::findById($id);

    $company->name = $params['name'] ?? $company->name;
    $company->fantasy_name = $params['fantasy_name'] ?? $company->fantasy_name;
    $company->cnpj = $params['cnpj'] ?? $company->cnpj;
    $company->phone = $params['phone'] ?? $company->phone;
    $company->tax_framework = $params['tax_framework'] ?? $company->tax_framework;
    $company->description = $params['description'] ?? $company->description;
    $company->link = $params['link'] ?? $company->link;
    $company->responsible = $params['responsible'] ?? $company->responsible;
    $company->status = $params['status'] ?? $company->status;
    $company->accounting_fees = $params['accounting_fees'] ?? $company->accounting_fees;
    $company->state_registration = $params['state_registration'] ?? $company->state_registration;
    $company->recorded_at = $params['recorded_at'] ?? $company->recorded_at;
    
    if ($company->save()) {
      FlashMessage::success('Empresa atualizada com sucesso!');
      $this->redirectTo(route('companies.index'));
    } else {
      FlashMessage::danger('Existem dados incorretos! Por favor verifique!');
      $this->render('companies/edit', compact('company'));
    }
  }

  public function destroy(Request $request): void
  {
    $params = $request->getParams();
    $id = (int) $params['id'];
    $company = Company::findById($id);

    if ($company && $company->delete()) {
      FlashMessage::success('Empresa excluída com sucesso!');
    } else {
      FlashMessage::danger('Não foi possível excluir a empresa. Por favor, tente novamente.');
    }

    $this->redirectTo(route('companies.index'));
  }
}
