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
            $table->id();
            $table->string('context',255);
            $table->text('description');
            $table->string('path',255);
            $table->unsignedBigInteger('professional_id');
            $table->foreign('professional_id')->references('id')->on('professional')->onDelete('cascade');
            $table->enum('status', ['Pendent','Resolt'])->default('Pendent');
            $table->timestamps();
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
