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
        Schema::create('machines', function (Blueprint $table) {
            $table->id('idMaquina');
            $table->string('nombre');
            $table->unsignedBigInteger('idCampus');
            $table->unsignedBigInteger('idSeccion');
            $table->integer('prioridad');
            $table->timestamps();

            $table->foreign('idCampus')->references('idCampus')->on('campuses');
            $table->foreign('idSeccion')->references('idSeccion')->on('sections');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
