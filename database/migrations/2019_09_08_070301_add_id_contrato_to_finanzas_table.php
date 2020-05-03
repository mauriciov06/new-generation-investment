<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdContratoToFinanzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finanzas', function (Blueprint $table) {
            if(!Schema::hasColumn('finanzas', 'id_contrato')){
                $table->integer('id_contrato')->nullable()->after('id_user');
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
