<?php 
namespace App\Tenant;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ManagerTenant{
    public function setConnection(Company $company){
        DB::purge('tenant');
        config()->set('database.connections.tenant.host', $company->db_host);
        config()->set('database.connections.tenant.database', $company->db_database);
        config()->set('database.connections.tenant.username', $company->db_user);
        config()->set('database.connections.tenant.password', $company->db_pass);
        DB::reconnect('tenant');
        
        Schema::connection('tenant')->getConnection()->reconnect();
    }

    /* função usada para verificar se o dominio atual é igual ao dominio principal para não atribuir a conexão no middleware */
    public function domainIsMain(){
        return (request()->getHost() == config('tenant.domain_main'));
    }
}
?>