<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatesToReferidosContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referidos_contratos', function (Blueprint $table) {
            if(!Schema::hasColumn('referidos_contratos', 'datetime_solicitud_temp')){
                $table->dateTime('datetime_solicitud_temp')->nullable()->after('estado_referido_contratos');
            }
            if(!Schema::hasColumn('referidos_contratos', 'datetime_solicitud')){
                $table->dateTime('datetime_solicitud')->nullable()->after('estado_referido_contratos');
            }
            if(!Schema::hasColumn('referidos_contratos', 'datatime_vencimiento')){
                $table->dateTime('datatime_vencimiento')->nullable()->after('estado_referido_contratos');
            }
            if(!Schema::hasColumn('referidos_contratos', 'datatime_activacion')){
                $table->dateTime('datatime_activacion')->nullable()->after('estado_referido_contratos');
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
