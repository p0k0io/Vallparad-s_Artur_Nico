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
        Schema::create('complementary_service_documents', function (Blueprint $table) {
            $table->id();
            $table->string('path',255);
            $table->unsignedBigInteger('complementaryService_id');
            $table->foreign('complementaryService_id')->references('id')->on('complementary_services')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complementary_service_documents');
    }
};
