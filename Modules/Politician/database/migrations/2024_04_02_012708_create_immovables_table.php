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
        Schema::create('immovables', function (Blueprint $table) {
            $table->string('description',128);
            $table->string('address',256);
            $table->tinyInteger('sunarp')->default(0);
            $table->string('record_sunarp',32)->nullable();
            $table->double('autovaluo',12,2)->nullable()->default(0.00);
            $table->double('value',12,2)->nullable()->default(0.00);
            $table->text('comment')->nullable();

            $table->foreignUuid('candidate_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('immovables');
    }
};
