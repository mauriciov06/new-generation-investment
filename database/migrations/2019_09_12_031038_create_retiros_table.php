<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if (!Schema::hasTable('retiros')) {
            Schema::create('retiros', function (Blueprint $table) {
                $table->bigIncrements('id_retiros');
                $table->integer('id_user');
                $table->integer('valor_retirar');
                $table->integer('id_referidos_contratos');
                $table->tinyInteger('estado_retiro')->default(0);
                $table->dateTime('fecha_solicitud_retiro')->nullable();
                $table->dateTime('fecha_confirmado_retiro')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retiros');
    }
}
