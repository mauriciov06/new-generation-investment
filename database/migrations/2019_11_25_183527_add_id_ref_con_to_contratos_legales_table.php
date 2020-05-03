<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdRefConToContratosLegalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contratos_legales', function (Blueprint $table) {
            if(!Schema::hasColumn('contratos_legales', 'id_referidos_contratos')){
                $table->integer('id_referidos_contratos')->nullable()->after('id_usuario');
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
        Schema::table('contratos_legales', function (Blueprint $table) {
            //
        });
    }
}
