<?php

namespace App\Listeners\Tenant;

use App\Events\CompanyCreated;
use App\Events\Tenant\DatabaseCreated;
use App\Tenant\Database\DatabaseManager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatedCompanyDatabase
{

    private $database;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DatabaseManager $database)
    {
        $this->database = $database;
    }

    /**
     * Handle the event.
     *
     * @param  CompanyCreated  $event
     * @return void
     */
    public function handle(CompanyCreated $event)
    {
        $company = $event->company();
        /* 
            aqui iremos apenas executar o processo para criação do banco, 
            pois é uma tarefa complexa e não pode ser executado tudo aqui
        */
        if (!$this->database->createDatabase($company)) {
            throw new \Exception('Erro ao criar o banco de dados...');
        }

        //rodando a criação de tabelas - migrates
        event(new DatabaseCreated($company));
    }
}
