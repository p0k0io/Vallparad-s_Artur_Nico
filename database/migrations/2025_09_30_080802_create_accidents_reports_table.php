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
        Schema::create('accidents_reports', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Sense Baixa','Amb Baixa','Baixa Llarga'])->default('Sense Baixa');
            $table->string('context',255);
            $table->text('description');
            $table->text('duration')->nullable();
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->enum('status', ['Baixa Finalitzada','En Baixa','Sense Baixa']);
            $table->unsignedBigInteger('professional_id');
            $table->foreign('professional_id')->references('id')->on('professional')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accidents_reports');
    }
};

