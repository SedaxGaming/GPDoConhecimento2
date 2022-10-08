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
            $table->timestamp('dataIncio')->nullable()->default('null');
            $table->timestamp('dataFim')->nullable()->default('null');
            $table->string('nome');
            $table->int('pontuacao');
            $table->int('numero');
            $table->foreignId('idpergunta');
            $table->foreignId('idusuarios');
            $table->foreign('idpergunta')->references('id')->on('perguntas');
            $table->foreign('idusuarios')->references('id')->on('usuarios');
            $table->tinyInteger('etapaAtual')->default('0');
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