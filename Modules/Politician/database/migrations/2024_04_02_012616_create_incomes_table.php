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
        Schema::create('incomes', function (Blueprint $table) {
            $table->double('public_remuneration',12,2)->default(0.00);
            $table->double('private_remuneration',12,2)->default(0.00);
            $table->double('public_rent',12,2)->default(0.00);
            $table->double('private_rent',12,2)->default(0.00);
            $table->double('public_other',12,2)->default(0.00);
            $table->double('private_other',12,2)->default(0.00);
            $table->double('total',12,2)->default(0.00);
            $table->year('year')->nullable();

            $table->foreignUuid('candidate_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
