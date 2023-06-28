<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\DatabaseCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class RunMigrationsTenant
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DatabaseCreated  $event
     * @return void
     */
    public function handle(DatabaseCreated $event)
    {
        $company = $event->company();

        info('$company->id: ' . $company->id);

        /* rodando as migrates aqui */
        $migration = Artisan::call('tenants:migrate', [
            'id' => $company->id,
        ]);

        /* agora iremos rodar as seeders */
        if ($migration == 0) {
            Artisan::call('db:seed', [
                '--class' => 'TenantsTableSeeder'
            ]);
        }

        return $migration === 0;
    }
}
