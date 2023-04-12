<?php

namespace App\Console\Commands\Tenant;

use App\Models\Company;
use App\Tenant\ManagerTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TenantMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * veja que aqui adicionamos um valor opcional (option) chamada refresh para determinar se irá resetar ou não as tabelas
     * obs.: para executar no command vc também precisa colocar o --
     */
    protected $signature = 'tenants:migrate {id?} {--refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rodando as migrates do tenants...';
    private $tenant;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ManagerTenant $tenant)
    {
        parent::__construct();
        $this->tenant = $tenant;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->argument('id')) {
            $empresa = Company::find($this->argument('id'));
            if ($empresa)
                $this->execCommand($empresa);
            return;
        } else{
            $empresas = Company::all();
            foreach ($empresas as $empresa) {
                $this->execCommand($empresa);
            }
        }
    }

    /* apenas executa as migrates para a empresa informada */
    public function execCommand($empresa){
        $command = $this->option('refresh') ? 'migrate:refresh' : 'migrate';

        /* aqui ele atribui a conexão para a empresa atual */
        $this->tenant->setConnection($empresa);

        /* exibindo log */
        $this->info('Empresa atual: ' . $empresa->name);

        Artisan::call($command, [
            '--force' => true,
            '--path' => '/database/migrations/tenant',
        ]);

        $this->info('Migrates executadas.');
        $this->info('Conexão finalizada.');
        $this->info('-------------------');
    }
}
