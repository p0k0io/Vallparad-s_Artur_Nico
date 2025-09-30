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
        Schema::create('professional_tracking', function (Blueprint $table) {
            $table->id();
            $table->string('type',255);
            $table->string('subject',255);
            $table->text('description');
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
        Schema::dropIfExists('professional_tracking');
    }
};
