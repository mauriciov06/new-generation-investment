<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProxiDiaToFinanzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finanzas', function (Blueprint $table) {
            if(!Schema::hasColumn('finanzas', 'fecha_aux_nexdia')){
                $table->date('fecha_aux_nexdia')->nullable()->after('id_referidos_contratos');
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
        Schema::table('finanzas', function (Blueprint $table) {
            //
        });
    }
}
