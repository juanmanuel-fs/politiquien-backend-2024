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
        Schema::create('postulations', function (Blueprint $table) {
            $table->id();
            $table->string('complete_plan',32)->nullable();
            $table->boolean('status')->default(true);
            $table->tinyInteger('state')->default(0);

            $table->foreignId('plan_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('electoral_jury_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('electionable_id')->constrained()->onDelete('cascade');
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->foreignId('process_id')->constrained()->onDelete('cascade');

            $table->timestamps();

            $table->unique(['electionable_id','organization_id','process_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulations');
    }
};
