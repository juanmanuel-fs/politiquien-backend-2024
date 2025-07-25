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
        Schema::create('movables', function (Blueprint $table) {
            $table->string('vehicle',128);
            $table->string('brand',64)->nullable();
            $table->string('plate',64)->nullable();
            $table->string('model',64)->nullable();
            $table->text('characteristic')->nullable();
            $table->year('year')->nullable();
            $table->double('value',12,2)->default(0.00);
            $table->text('comment')->nullable();

            $table->foreignUuid('candidate_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movables');
    }
};
