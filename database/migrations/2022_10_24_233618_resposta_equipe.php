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
        Schema::create('resposta_equipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idetapas')->nullable();
            $table->foreign('idetapas')->references('id')->on('etapas');
            $table->foreignId('idusuarios')->nullable();
            $table->foreign('idusuarios')->references('id')->on('usuarios');
            $table->string('resposta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resposta_equipes');
    }
};
