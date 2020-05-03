<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConsecutivoFinanzaToFinanzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finanzas', function (Blueprint $table) {
            if(!Schema::hasColumn('finanzas', 'id_referidos_contratos')){
            $table->integer('id_referidos_contratos')->nullable()->after('estado_finanza');
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
