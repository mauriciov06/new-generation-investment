<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFechaAuxUpgradeContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('upgrade_contratos', function (Blueprint $table) {
            if(!Schema::hasColumn('upgrade_contratos', 'fecha_aux_upgrade')){
                $table->dateTime('fecha_aux_upgrade')->nullable()->after('fecha_upgrade');
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
        Schema::table('upgrade_contratos', function (Blueprint $table) {
            //
        });
    }
}
