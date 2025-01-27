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
        Schema::create('interventions', function (Blueprint $table) {
            $table->id('idIntervencion');
            $table->unsignedBigInteger('idTecnico');
            $table->unsignedBigInteger('idIncidencia');
            $table->dateTime('fechaInicio');
            $table->dateTime('fechaFin');
            $table->text('notas')->nullable();
            $table->timestamps();

            $table->foreign('idTecnico')->references('idUsuario')->on('users');
            $table->foreign('idIncidencia')->references('idIncidencia')->on('incidences');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
