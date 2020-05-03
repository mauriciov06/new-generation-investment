<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpgradeContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if (!Schema::hasTable('upgrade_contratos')) {
            Schema::create('upgrade_contratos', function (Blueprint $table) {
                $table->bigIncrements('id_upgrade_contratos');
                $table->integer('id_user');
                $table->integer('id_referencia_contrato');
                $table->integer('id_finanza');
                $table->integer('valor_upgrade');
                $table->float('valor_utilidad_anterior',18,16);
                $table->string('valor_diario_anterior');
                $table->integer('valor_inversion_anterior');
                $table->dateTime('fecha_upgrade')->nullable();
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
        Schema::dropIfExists('upgrade_contratos');
    }
}
