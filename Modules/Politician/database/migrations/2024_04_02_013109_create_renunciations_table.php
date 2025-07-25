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
        Schema::create('renunciations', function (Blueprint $table) {
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
        Schema::dropIfExists('renunciations');
    }
};
