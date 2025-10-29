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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->integer('P1');
            $table->integer('P2');
            $table->unsignedBigInteger('evaluated');
            $table->foreign('evaluated')->references('id')->on('professional')->onDelete('cascade');
            $table->unsignedBigInteger('evaluator');
            $table->foreign('evaluator')->references('id')->on('professional')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
