<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Emerson',
            'email' => 'emerson@sygmasistemas.com.br',
            'password' => bcrypt('DeusEhBom'),
        ]);
    }
}
