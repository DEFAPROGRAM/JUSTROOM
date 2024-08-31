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
        Schema::create('audiencias', function (Blueprint $table) {
            $table->id('id_audiencia');
            $table->unsignedBigInteger('id_sala')->nullable();
            $table->unsignedBigInteger('id_juzgado')->nullable();
            $table->text('descripcion')->nullable();
            $table->date('fecha')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();
            $table->timestamps();

            $table->foreign('id_sala')->references('id_sala')->on('salas')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('id_juzgado')->references('id_juzgado')->on('juzgados')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audiencias');
    }
};
