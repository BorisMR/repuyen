<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_envio')->unsigned();
            $table->timestamps();

            //todo: crear claves foraneas en proxima migracion
            /*
            $table->foreign('fk_seguimientos_users')
                ->references('id')
                ->on('users');
            $table->foreign('fk_seguimientos_envios')
                ->references('id')
                ->on('envios');
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguimientos');
    }
}
