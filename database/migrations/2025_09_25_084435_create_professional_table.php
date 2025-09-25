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
        Schema::create('professional', function (Blueprint $table) {
            $table->id();
            $table->string('surname1',50);
            $table->string('surname2',50);
            $table->string('name',50);
            $table->string('email',150);
            $table->string('address',255);
            $table->string('phone',9);
            $table->string('profession',100);
            $table->string('linkStatus',100);
            $table->foreign('key_id')->references('id')->on('keys')->onDelete('cascade');
            $table->foreign('locker_id')->references('id')->on('lockers')->onDelete('cascade');
            $table->foreign('center_id')->references('id')->on('centers')->onDelete('cascade');
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('uniform_id')->references('id')->on('uniforms')->onDelete('cascade');
            $table->foreign('cv_id')->references('id')->on('cv')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional');
    }
};
