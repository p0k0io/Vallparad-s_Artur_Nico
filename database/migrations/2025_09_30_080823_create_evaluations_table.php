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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->integer('P1');
            $table->integer('P2');
            $table->integer('P3');
            $table->integer('P4');
            $table->integer('P5');
            $table->integer('P6');
            $table->integer('P7');
            $table->integer('P8');
            $table->integer('P9');
            $table->integer('P10');
            $table->integer('P11');
            $table->integer('P12');
            $table->integer('P13');
            $table->integer('P14');
            $table->integer('P15');
            $table->integer('P16');
            $table->integer('P17');
            $table->integer('P18');
            $table->integer('P19');
            $table->integer('P20');
            $table->unsignedBigInteger('evaluated');
            $table->foreign('evaluated')->references('id')->on('professional')->onDelete('cascade');
            $table->unsignedBigInteger('evaluator');
            $table->foreign('evaluator')->references('id')->on('professional')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
