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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id('id_reserva');
            $table->unsignedBigInteger('id_audiencia');
            $table->unsignedBigInteger('id_usuario');
            $table->date('fecha_reserva')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('estado', 50)->nullable();
            $table->timestamps();

            $table->foreign('id_audiencia')->references('id_audiencia')->on('audiencias')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
