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
        Schema::create('process_summaries', function (Blueprint $table) {
            $table->tinyInteger('organizations')->default(0);
            $table->tinyInteger('candidates')->default(0);
            $table->tinyInteger('foreigners')->default(0);

            $table->foreignId('process_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process_summaries');
    }
};
