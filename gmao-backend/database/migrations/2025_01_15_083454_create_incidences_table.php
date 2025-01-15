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
        Schema::create('incidences', function (Blueprint $table) {
            $table->id('idIncidencia');
            $table->unsignedBigInteger('idMaquina');
            $table->date('fechaReporte');
            $table->string('descripcion');
            $table->date('fechaResolucion')->nullable();
            $table->string('estadoIncidencia');
            $table->string('estadoMaquina');
            $table->boolean('habilitada');
            $table->timestamps();

            $table->foreign('idMaquina')->references('idMaquina')->on('machines');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidences');
    }
};
