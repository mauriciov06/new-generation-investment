<?php

use Illuminate\Database\Seeder;

class ContratosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contratos')->insert([
        	'id_contrato' => 1,
            'nombre_contrato' => 'Contrato Mensual',
        ]);

        DB::table('contratos')->insert([
        	'id_contrato' => 2,
            'nombre_contrato' => 'Contrato Bimestral',
        ]);

        DB::table('contratos')->insert([
        	'id_contrato' => 3,
            'nombre_contrato' => 'Contrato Trimestral',
        ]);

        DB::table('contratos')->insert([
            'id_contrato' => 4,
            'nombre_contrato' => 'Contrato Empresarial',
        ]);
    }
}
