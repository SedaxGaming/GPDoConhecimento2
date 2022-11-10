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
        Schema::create('provas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('numero');
            $table->foreignId('ganhador')->nullable();
            $table->foreignId('idetapas');
            $table->foreign('ganhador')->references('id')->on('usuarios');
            $table->foreign('idetapas')->references('id')->on('etapas');
            $table->tinyInteger('provaAtual')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provas');
    }
};
