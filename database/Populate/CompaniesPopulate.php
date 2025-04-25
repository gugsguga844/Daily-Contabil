<?php

namespace Database\Populate;

use App\Models\Company;

class CompaniesPopulate
{
    public static function populate()
    {
        $data =  [
            'name' => 'Polly Serviços Contábeis LTDA',
            'fantasy_name' => 'Escritorio Contabil Polly',
            'cnpj' => '81.635.898/0001-76',
            'phone' => '3035-1711',
            'tax_framework' => 'Simples Nacional',
            'description' => '',
            'link' => 'https://www.youtube.com/embed/yMrPeRD5Www?si=K012I1z-Q7WqzxOk',
            'responsible' => 'Adrieli',
            'status' => 'Ativo',
            'accounting_fees' => 'R$0,00',
            'state_registration' => 'Não Possui',
        ];
    
        $company = new Company($data);
        $company->save();

        echo "Companies populated with 1 registers\n";
    }
}
