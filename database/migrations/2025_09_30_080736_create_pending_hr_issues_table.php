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
        Schema::create('pending_hr_issues', function (Blueprint $table) {
            $table->id();
            $table->string('context',100);
            $table->text('description');
            $table->enum('status', ['Pendent','Resolt'])->default('Pendent');
            $table->text('signature')->nullable();
            $table->unsignedBigInteger('professional_id');
            $table->foreign('professional_id')->references('id')->on('professional')->onDelete('cascade');
            $table->unsignedBigInteger('professional_afectat');
            $table->foreign('professional_afectat')->references('id')->on('professional')->onDelete('cascade');
            $table->unsignedBigInteger('professional_derivat');
            $table->foreign('professional_derivat')->references('id')->on('professional')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_hr_issues');
    }
};
