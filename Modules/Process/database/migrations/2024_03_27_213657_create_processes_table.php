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
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('jne_id')->nullable()->unique();
            $table->string('title',256)->unique();
            $table->string('slug',256)->unique();
            $table->string('subtitle',256)->nullable();
            $table->text('slogan')->nullable();
            $table->text('description')->nullable();
            $table->date('date');
            $table->boolean('is_current')->default(false);
            $table->boolean('status')->default(false);
            $table->foreignId('process_id')->nullable()->constrained()->onDelete('cascade');

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processes');
    }
};
