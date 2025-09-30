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
        Schema::create('projects_comisions_documentation', function (Blueprint $table) {
            $table->id();
            $table->string('nom',255);
            $table->string('path',255);
            $table->unsignedBigInteger('project_comision_id');
            $table->foreign('project_comision_id')->references('id')->on('projects_comisions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects_comisions_documentation');
    }
};
