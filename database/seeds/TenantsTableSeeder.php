<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Padrão',
            'email' => 'emerson@sygmasistemas.com.br',
            'password' => bcrypt('DeusEhMais'),
        ]);
    }
}
