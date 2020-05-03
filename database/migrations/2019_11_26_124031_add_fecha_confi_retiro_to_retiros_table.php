<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFechaConfiRetiroToRetirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retiros', function (Blueprint $table) {
            if(!Schema::hasColumn('retiros', 'fecha_confi_retiro')){
                $table->date('fecha_confi_retiro')->nullable()->after('fecha_confirmado_retiro');
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
