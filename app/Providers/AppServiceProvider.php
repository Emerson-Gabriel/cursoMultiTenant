<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /* Exemplo de criação de diretivas para views */
        Blade::if('tenant', function () {
            return request()->getHost() != config('tenant.domain_main');/* no meu caso seria o domínio principal curso.tenant */
        });

        Blade::if('tenantmain', function () {
            return request()->getHost() == config('tenant.domain_main');
        });
    }
}
