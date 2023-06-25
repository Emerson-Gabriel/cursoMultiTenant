<?php

namespace App\Http\Controllers\Tenant;

use App\Events\CompanyCreated;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    private $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function store(Request $request){
        /* realizando cadastro com valores fakes */
        $random = rand(1, 1000);
        $company = $this->company->create([
            'name' => 'Empresa do Zeka ' . $random,
            'domain' => 'empresa.do.zeka' . $random,
            'db_database' => 'cursolaravelmultizeka' . $random,
            'db_host' => 'mysql',
            'db_user' => 'root',
            'db_pass' => $random,
        ]);

        event(new CompanyCreated($company));

        dd($company);
    }
}
