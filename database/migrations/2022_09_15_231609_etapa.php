<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etapas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('dataIncio');
            $table->timestamp('dataFim');
            $table->string('nome');
            $table->double('pontuacao',3,2);
            $table->string('respostaCorreta');
            $table->foreignId('idpergunta');
            $table->foreignId('idusuarios');
            $table->foreign('idpergunta')->references('id')->on('perguntas');
            $table->foreign('idusuarios')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etapas');
    }
};