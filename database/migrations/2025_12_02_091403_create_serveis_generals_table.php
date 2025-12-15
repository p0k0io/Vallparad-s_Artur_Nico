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
        Schema::create('serveis_generals', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('center_id');
        $table->foreign('center_id')->references('id')->on('centers')->onDelete('cascade');
        $table->text('responsable');
        $table->json('personal_info');
        $table->text('nom_servei');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serveis_generals');
    }
};
