<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSinodaliasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinodalias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('periodo_id')->unsigned();
            $table->string('residente');
            $table->string('carrera');
            $table->double('num_control');
            $table->string('proyecto');
            // $table->integer('id_presidente')->unsigned();
            $table->integer('id_secretario')->unsigned();
            $table->integer('id_vocal')->unsigned();
            $table->integer('id_vocal_sup')->unsigned();
            $table->boolean('aprobacion');
            $table->timestamps();

            // foreign keys
            // presidente
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            // para asignar periodo
            $table->foreign('periodo_id')
                    ->references('id')
                    ->on('periodos')
                    ->onDelete('cascade');

        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sinodalias');
    }
}
