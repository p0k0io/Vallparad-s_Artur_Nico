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
        Schema::create('project_comision_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ProjCom_id');
            $table->foreign('ProjCom_id')->references('id')->on('projects_comisions')->onDelete('cascade');
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
        Schema::dropIfExists('project_comision_assignments');
    }
};
