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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street',256)->nullable();
            $table->boolean('is_birth')->default(false);
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->char('ubigeo',12)->nullable();
            $table->char('addressable_id');
            $table->string('addressable_type',64);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
