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
        Schema::table('incidences', function (Blueprint $table) {
            $table->string('gravedad')->after('habilitada');
            $table->unsignedBigInteger('idAveria')->after('gravedad');

            $table->foreign('idAveria')->references('idAveria')->on('breakdowns');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incidences', function (Blueprint $table) {
            $table->dropForeign(['idAveria']);
            $table->dropColumn('gravedad');
            $table->dropColumn('idAveria');
        });
    }
};