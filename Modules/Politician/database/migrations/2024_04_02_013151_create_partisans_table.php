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
        Schema::create('partisans', function (Blueprint $table) {
            $table->string('position')->nullable();
            $table->year('started_at')->nullable();
            $table->year('ended_at')->nullable();
            $table->text('comment')->nullable();
            $table->string('organization',128)->nullable();

            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('candidate_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partisans');
    }
};
