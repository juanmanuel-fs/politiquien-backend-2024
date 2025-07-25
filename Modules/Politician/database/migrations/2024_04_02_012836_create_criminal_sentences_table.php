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
        Schema::create('criminal_sentences', function (Blueprint $table) {
            $table->string('expedient',64)->nullable();
            $table->date('date')->nullable();
            $table->string('judicial_authority',128)->nullable();
            $table->text('crime')->nullable();
            $table->text('ruling')->nullable();
            $table->string('morality',64)->nullable();
            $table->string('other_morality',64)->nullable();
            $table->string('ruling_fulfilled',64)->nullable();
            $table->text('comment')->nullable();

            $table->foreignUuid('candidate_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criminal_sentences');
    }
};
