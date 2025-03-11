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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->string('reg_no')->nullable();
            $table->json('after')->nullable();
            $table->json('before')->nullable();
            $table->json('diff')->nullable();
            $table->dateTime('record_created_at')->nullable();
            $table->dateTime('record_updated_at')->nullable();
            $table->dateTime('record_deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
