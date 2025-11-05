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
            $table->enum('type', ['obert', 'restringit','fi de la vinculacio'])->default('obert');
            $table->string('subject',255);
            $table->text('description');
            $table->unsignedBigInteger('tracked');
            $table->foreign('tracked')->references('id')->on('professional')->onDelete('cascade');
            $table->unsignedBigInteger('tracker');
            $table->foreign('tracker')->references('id')->on('professional')->onDelete('cascade');
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
