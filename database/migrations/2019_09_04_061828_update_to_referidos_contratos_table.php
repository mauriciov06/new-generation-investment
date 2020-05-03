<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateToReferidosContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referidos_contratos', function (Blueprint $table) {
            if(!Schema::hasColumn('referidos_contratos', 'valor_inversion')){
                $table->integer('valor_inversion')->nullable()->after('id_paquete');    
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('referidos_contratos', function (Blueprint $table) {
            //
        });
    }
}
