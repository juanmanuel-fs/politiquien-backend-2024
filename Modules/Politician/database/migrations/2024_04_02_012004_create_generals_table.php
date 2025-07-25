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
        Schema::create('generals', function (Blueprint $table) {
            $table->char('dni',12)->unique();
            $table->string('name',64);
            $table->string('father_surname',32);
            $table->string('mother_surname',32)->nullable();
            $table->tinyInteger('sex')->default(1);
            $table->date('birth');

            $table->foreignUuid('candidate_id')->constrained('candidates', 'id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generals');
    }
};
