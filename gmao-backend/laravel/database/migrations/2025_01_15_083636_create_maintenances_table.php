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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id('idMantenimiento');
            $table->unsignedBigInteger('idTarea');
            $table->unsignedBigInteger('idMaquina');
            $table->integer('frecuencia');
            $table->date('ultimoMantenimiento');
            $table->date('proximoMantenimiento');
            $table->timestamps();

            $table->foreign('idTarea')->references('idTarea')->on('tasks');
            $table->foreign('idMaquina')->references('idMaquina')->on('machines');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
