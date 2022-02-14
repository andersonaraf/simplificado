<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \DB::table('generos')->delete();
        \DB::table('generos')->insert([
            1 =>
                array(
                    'name' => 'Masculino',
                    'created_at' => now(),
                    'updated_at' => now()
                ),
            2 =>
                array(
                    'type' => 'Feminino',
                    'created_at' => now(),
                    'updated_at' => now()
                ),
            3 =>
                array(
                    'type' => 'Transgênero',
                    'created_at' => now(),
                    'updated_at' => now()
                ),
            4 =>
                array(
                    'type' => 'Não-binário',
                    'created_at' => now(),
                    'updated_at' => now()
                ),
            5 =>
                array(
                    'type' => 'Não informar',
                    'created_at' => now(),
                    'updated_at' => now()
                ),
        ]);

    }
}
