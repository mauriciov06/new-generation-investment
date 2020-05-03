<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstadoToFinanzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finanzas', function (Blueprint $table) {
            if(!Schema::hasColumn('finanzas', 'estado_finanza')){
                $table->tinyInteger('estado_finanza')->default(0)->after('valor_diario');
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
