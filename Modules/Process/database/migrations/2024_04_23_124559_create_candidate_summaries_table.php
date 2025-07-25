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
        Schema::create('candidate_summaries', function (Blueprint $table) {
            $table->tinyInteger('occupations')->default(0);
            $table->tinyInteger('basics')->default(0);
            $table->tinyInteger('notColleges')->default(0);
            $table->tinyInteger('colleges')->default(0);
            $table->tinyInteger('technicals')->default(0);
            $table->tinyInteger('postgraduates')->default(0);
            $table->tinyInteger('otherPostgraduates')->default(0);
            $table->tinyInteger('partisans')->default(0);
            $table->tinyInteger('electeds')->default(0);
            $table->tinyInteger('renunciations')->default(0);
            $table->tinyInteger('obligatorySentences')->default(0);
            $table->tinyInteger('criminalSentences')->default(0);
            $table->tinyInteger('incomes')->default(0);
            $table->tinyInteger('immovables')->default(0);
            $table->tinyInteger('movables')->default(0);
            $table->tinyInteger('properties')->default(0);

            $table->tinyInteger('administratives')->default(0);
            $table->tinyInteger('fiscals')->default(0);
            $table->tinyInteger('judicials')->default(0);
            $table->tinyInteger('transits')->default(0);

            $table->foreignUuid('candidate_id')->constrained('candidates', 'id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_summaries');
    }
};
