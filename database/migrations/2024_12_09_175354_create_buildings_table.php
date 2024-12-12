<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('architect_id');
            $table->string('name', 256);
            $table->text('description')->nullable();
            $table->integer('year');
            $table->string('image', 256)->nullable();
            $table->boolean('display');
            $table->timestamps();
            $table->foreign('architect_id')->references('id')->on('architects');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
