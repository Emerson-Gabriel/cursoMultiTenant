<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\CompanyCreated;
use App\Events\Tenant\DatabaseCreated;
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
        /* aqui vc pode criar bancos em outros servidores por exemplo */
        $company = $this->company->create([
            'name' => 'Empresa do Zeka ' . $random,
            'domain' => 'empresa.do.zeka' . $random,
            'db_database' => 'cursolaravelmultizeka' . $random,
            //'db_database' => 'lixeira',
            'db_host' => '127.0.0.1',
            'db_user' => 'root',
            'db_pass' => '',
        ]);

        /* 
            exemplificando a criação apenas das migrates em um banco ja existente em outro server, 
            atribuir false caso queira criar apenas as migrate
        */
        if (true)
            event(new CompanyCreated($company));
        else
            event(new DatabaseCreated($company));

        dd($company);
    }
}
