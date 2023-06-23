<?php

namespace App\Http\Middleware\Tenant;

use App\Http\Controllers\RedirectBadController;
use App\Models\Company;
use App\Tenant\ManagerTenant;
use Closure;

class TenantMiddleware
{
    protected $redirectTo = '/admin';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $manager = app(ManagerTenant::class);

        $tenant = $this->getCompany($request->getHost());
        
        if (!$tenant && $request->url() != route('404.tenant')) {
            return redirect()->route('404.tenant');
        } else if (($request->url() != route('404.tenant')) && (!$manager->domainIsMain())){
            $manager->setConnection($tenant);
        }
        
        return $next($request);

        /* LIXO */
            //return view('errors.404');
            //return redirect('/erro404');
            //return redirect()->action('RedirectController@erro404');
            //return $next(route('pagina404'));
            //return redirect()->route('erro404');
        /* caso encontrou o dominio */
    }

    public function getCompany($host) {
        return Company::where('domain', $host)->first();
    }
}
