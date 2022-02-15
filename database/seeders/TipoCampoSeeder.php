<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoCampoSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('tipo_campos')->delete();

        \DB::table('tipo_campos')->insert([
            0 =>
                array(
                    'tipo' => 'Texto',
                    'created_at' => now(),
                    'updated_at' => now()
                ),
            1 =>
                array(
                    'type' => 'Arquivo',
                    'created_at' => now(),
                    'updated_at' => now()
                ),
            2 =>
                array(
                    'type' => 'Selecionar',
                    'created_at' => now(),
                    'updated_at' => now()
                ),
            3 =>
                array(
                    'type' => 'Data',
                    'created_at' => now(),
                    'updated_at' => now()
                ),
        ]);
    }
}
