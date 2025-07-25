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
        Schema::create('obligatory_sentences', function (Blueprint $table) {
            $table->string('expedient',64)->nullable();
            $table->text('matter')->nullable();
            $table->string('judicial_authority',128)->nullable();
            $table->text('ruling')->nullable();
            $table->text('comment')->nullable();

            $table->foreignUuid('candidate_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obligatory_sentences');
    }
};
