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
        Schema::create('rrhh_tracking', function (Blueprint $table) {
            $table->id();
            $table->string('context',100);
            $table->text('description');
            $table->unsignedBigInteger('rrhh_id');
            $table->foreign('rrhh_id')->references('id')->on('pending_hr_issues')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rrhh_tracking');
    }
};
