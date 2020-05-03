<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->string('name');
            $table->string('email')->unique();
            $table->tinyInteger('id_tipo_cuenta');
            $table->string('avatar_users')->nullable();
            $table->string('direccion_users')->nullable();
            $table->string('telefono_users', 30)->nullable();
            $table->string('celular_users', 30)->nullable();
            $table->integer('id_pais');
            $table->string('codigo_referido_users')->nullable();
            $table->string('codigo_referido_padre_users')->nullable();
            $table->tinyInteger('estado_users')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
