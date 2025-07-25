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
        Schema::create('candidates', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique()->index();
            $table->bigInteger('jne_id')->unique();
            $table->string('full_name', 256);
            $table->string('slug', 256);
            $table->string('keywords', 1024)->nullable();
            $table->string('image',256)->nullable();
            $table->char('dni', 12);
            $table->tinyInteger('state')->default(0);
            $table->boolean('status')->default(true);
            $table->tinyInteger('number')->default(0);
            $table->foreignId('process_id')->constrained()->onDelete('cascade');
            $table->foreignId('postulation_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('position_id')->nullable()->constrained()->onDelete('cascade');

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
