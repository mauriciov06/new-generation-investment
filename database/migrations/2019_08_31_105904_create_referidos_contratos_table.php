<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferidosContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referidos_contratos', function (Blueprint $table) {
            $table->bigIncrements('id_referidos_contratos');
            $table->integer('id_user');
            $table->integer('id_contrato');
            $table->integer('id_paquete');
            $table->tinyInteger('estado_referido_contratos')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referidos_contratos');
    }
}
