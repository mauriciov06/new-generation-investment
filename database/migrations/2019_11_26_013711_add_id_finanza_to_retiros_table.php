<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdFinanzaToRetirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retiros', function (Blueprint $table) {
            if(!Schema::hasColumn('retiros', 'id_finanza')){
                $table->integer('id_finanza')->after('id_user');
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
        Schema::table('retiros', function (Blueprint $table) {
            //
        });
    }
}
