<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'administrador',
            'email' => 'administrador@riobranco.ac.gov.br',
            'email_verified_at' => now(),
            'password' => Hash::make('master@2378'),
            'tipo' => 'Admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
