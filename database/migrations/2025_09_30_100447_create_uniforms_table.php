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
        Schema::create('uniforms', function (Blueprint $table) {
    $table->id();

    $table->string('shirtSize', 4);
    $table->string('pantsSize', 4);
    $table->integer('shoeSize');

    // Cambiamos 'lastUniform' de date a unsignedBigInteger
    $table->unsignedBigInteger('lastUniform')->nullable(); // puede ser nulo si no hay uniforme anterior

   $table->unsignedBigInteger('professional_id'); $table->foreign('professional_id')->references('id')->on('professional')->onDelete('cascade');

    // Foreign key auto-referencial a la misma tabla
    $table->foreign('lastUniform')
          ->references('id')
          ->on('uniforms')
          ->onDelete('set null'); // si se elimina el uniforme anterior, se pone null

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uniforms');
    }
};
