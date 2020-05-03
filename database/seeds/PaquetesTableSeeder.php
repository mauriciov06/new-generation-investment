<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaquetesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paquetes')->insert([
        	'id_paquete' => 1,
            'nombre_paquete' => 'Pack - 100 USD',
            'valor_paquete' => 100,
        ]);

        DB::table('paquetes')->insert([
        	'id_paquete' => 2,
            'nombre_paquete' => 'Pack - 200 USD',
            'valor_paquete' => 200,
        ]);

        DB::table('paquetes')->insert([
        	'id_paquete' => 3,
            'nombre_paquete' => 'Pack - 400 USD',
            'valor_paquete' => 400,
        ]);

        DB::table('paquetes')->insert([
        	'id_paquete' => 4,
            'nombre_paquete' => 'Pack - 800 USD',
            'valor_paquete' => 800,
        ]);

        DB::table('paquetes')->insert([
        	'id_paquete' => 5,
            'nombre_paquete' => 'Pack - 1000 USD',
            'valor_paquete' => 1000,
        ]);

        DB::table('paquetes')->insert([
        	'id_paquete' => 6,
            'nombre_paquete' => 'Pack - 2000 USD',
            'valor_paquete' => 2000,
        ]);

       	DB::table('paquetes')->insert([
        	'id_paquete' => 7,
            'nombre_paquete' => 'Pack - 3000 USD',
            'valor_paquete' => 3000,
        ]);

        DB::table('paquetes')->insert([
        	'id_paquete' => 8,
            'nombre_paquete' => 'Pack - 5000 USD',
            'valor_paquete' => 5000,
        ]);

        DB::table('paquetes')->insert([
        	'id_paquete' => 9,
            'nombre_paquete' => 'Pack - 10000 USD',
            'valor_paquete' => 10000,
        ]);

        DB::table('paquetes')->insert([
        	'id_paquete' => 10,
            'nombre_paquete' => 'Pack - 15000 USD',
            'valor_paquete' => 15000,
        ]);

        DB::table('paquetes')->insert([
        	'id_paquete' => 11,
            'nombre_paquete' => 'Pack - 20000 USD',
            'valor_paquete' => 20000,
        ]);

        DB::table('paquetes')->insert([
        	'id_paquete' => 12,
            'nombre_paquete' => 'Pack - 30000 USD',
            'valor_paquete' => 30000,
        ]);

        DB::table('paquetes')->insert([
        	'id_paquete' => 13,
            'nombre_paquete' => 'Pack - 50000 USD',
            'valor_paquete' => 50000,
        ]);

        DB::table('paquetes')->insert([
        	'id_paquete' => 14,
            'nombre_paquete' => 'Pack - 100000 USD',
            'valor_paquete' => 100000,
        ]);
    }
}
