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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('mode', ['onsite', 'online'])->default('onsite');
            $table->boolean('workshop')->default(false);
            $table->boolean('seminar')->default(false);
            $table->boolean('congress')->default(false);
            $table->string('attendee',255);
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->unsignedBigInteger('center_id');
            $table->foreign('center_id')->references('id')->on('keys')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
