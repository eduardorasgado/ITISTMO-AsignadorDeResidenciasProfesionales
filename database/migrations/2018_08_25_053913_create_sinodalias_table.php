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
            $table->string('residente');
            $table->string('carrera');
            $table->double('num_control');
            $table->string('proyecto');
            $table->integer('id_presidente')->unsigned();
            $table->integer('id_secretario')->unsigned();
            $table->integer('id_vocal')->unsigned();
            $table->integer('id_vocal_sup')->unsigned();
            $table->boolean('aprobacion');
            $table->timestamps();

            // foreign keys
            // presidente
            $table->foreign('id_presidente')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            // secretario
            // $table->foreign('id_secretario')
            //         ->references('id')
            //         ->on('users')
            //         ->onDelete('cascade');
            // // vocal
            // $table->foreign('id_vocal')
            //         ->references('id')
            //         ->on('users')
            //         ->onDelete('cascade');
            // // vocal suplente
            // $table->foreign('id_vocal_sup')
            //         ->references('id')
            //         ->on('users')
            //         ->onDelete('cascade');
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
