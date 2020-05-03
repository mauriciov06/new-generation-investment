<?php

use Illuminate\Database\Seeder;

class PaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paises')->insert([
        	'id_pais' => 1,
            'nombre_pais' => 'Colombia',
        ]);

        DB::table('paises')->insert([
        	'id_pais' => 2,
            'nombre_pais' => 'Ecuador',
        ]);

        DB::table('paises')->insert([
        	'id_pais' => 3,
            'nombre_pais' => 'Bolivia',
        ]);

        DB::table('paises')->insert([
        	'id_pais' => 4,
            'nombre_pais' => 'Peru',
        ]);

        DB::table('paises')->insert([
        	'id_pais' => 5,
            'nombre_pais' => 'Argentina',
        ]);

        DB::table('paises')->insert([
        	'id_pais' => 6,
            'nombre_pais' => 'Mexico',
        ]);

        DB::table('paises')->insert([
        	'id_pais' => 7,
            'nombre_pais' => 'Estados Unidos',
        ]);

        DB::table('paises')->insert([
        	'id_pais' => 8,
            'nombre_pais' => 'Canadá',
        ]);

        DB::table('paises')->insert([
        	'id_pais' => 9,
            'nombre_pais' => 'España',
        ]);

        DB::table('paises')->insert([
        	'id_pais' => 10,
            'nombre_pais' => 'República Dominicana',
        ]);

        DB::table('paises')->insert([
        	'id_pais' => 11,
            'nombre_pais' => 'Chile',
        ]);

        DB::table('paises')->insert([
            'id_pais' => 12,
            'nombre_pais' => 'Otro país',
        ]);

    }
}
