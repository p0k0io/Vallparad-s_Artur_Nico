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
        Schema::create('projects_comisions', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->text('description');
            $table->text('observations');
            $table->enum('type', ['project', 'comision'])->default('project');
            $table->unsignedBigInteger('professional_id');
            $table->foreign('professional_id')->references('id')->on('professional')->onDelete('cascade');
            $table->unsignedBigInteger('center_id');
            $table->foreign('center_id')->references('id')->on('centers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects_comisions');
    }
};
