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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->integer('jne_id')->nullable()->unique();
            $table->string('name',128);
            $table->string('slug',128)->unique();
            $table->longText('description')->nullable();
            $table->string('image',256)->nullable();
            $table->tinyInteger('type')->default(0);
            $table->date('registered_at')->nullable();
            $table->char('phone1')->nullable();
            $table->char('phone2')->nullable();
            $table->string('website',256)->nullable()->unique();
            $table->string('email',128)->nullable();
            $table->string('holder',128)->nullable();
            $table->string('alternate',128)->nullable();
            $table->tinyInteger('registered')->default(0);
            $table->text('comment')->nullable();
            $table->tinyInteger('state')->default(0);
            $table->boolean('status')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
