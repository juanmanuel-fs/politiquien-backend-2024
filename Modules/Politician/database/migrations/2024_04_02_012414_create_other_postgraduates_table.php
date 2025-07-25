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
        Schema::create('other_postgraduates', function (Blueprint $table) {
            $table->string('university',256)->nullable();
            $table->text('specialty')->nullable();
            $table->tinyInteger('concluded')->default(0);
            $table->tinyInteger('is_graduate')->default(0);
            $table->string('degree',128)->nullable();
            $table->year('year_degree')->nullable();
            $table->text('comment')->nullable();

            $table->foreignUuid('candidate_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_postgraduates');
    }
};
