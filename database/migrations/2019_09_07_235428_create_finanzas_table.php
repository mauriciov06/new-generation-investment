<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('finanzas')) {
            Schema::create('finanzas', function (Blueprint $table) {
                $table->bigIncrements('id_finanza');
                if(!Schema::hasColumn('finanzas', 'id_user')){
                    $table->integer('id_user')->nullable();
                }
                
                if(!Schema::hasColumn('finanzas', 'valor_utilidad')){
                    $table->float('valor_utilidad', 18,16)->nullable();
                }
                
                if(!Schema::hasColumn('finanzas', 'ganancia_diaria')){
                    $table->decimal('ganancia_diaria', 18,16)->nullable();
                }
                
                if(!Schema::hasColumn('finanzas', 'valor_diario')){
                    $table->string('valor_diario')->nullable();
                }
                
                $table->timestamps();
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finanzas');
    }
}
