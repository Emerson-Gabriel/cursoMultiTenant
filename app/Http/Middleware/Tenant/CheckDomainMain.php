<?php

namespace App\Http\Middleware\Tenant;

use Closure;

class CheckDomainMain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* se o dominio for o mesmo do arquivo de config então entra caso contário nao */
        if (request()->getHost() != config('tenant.domain_main')){
            abort(401);
        }

        return $next($request);
    }
}
