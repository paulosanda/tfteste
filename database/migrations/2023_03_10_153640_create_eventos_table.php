<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_do_evento');
            $table->string('nome_do_patrocinador');
            $table->date('data_do_evento');
            $table->dateTime('data_de_criacao');
            $table->string('local');
            $table->string('nome_do_artista');
            $table->time('horario_de_inicio');
            $table->integer('duracao');
            $table->integer('lotacao_maxima');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
