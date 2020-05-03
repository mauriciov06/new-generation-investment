<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHashReferidosContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referidos_contratos', function (Blueprint $table) {
            if(!Schema::hasColumn('referidos_contratos', 'hash_pago')){
                $table->text('hash_pago')->nullable()->after('estado_referido_contratos');
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
