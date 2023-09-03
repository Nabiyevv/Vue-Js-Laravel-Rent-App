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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('image');
            $table->string('location');
            $table->string('city');
            $table->string('category');
            $table->integer('price');
            $table->integer('count');
            $table->timestamps();
            
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // use this or this 2 lines below
            // $table->foreignId('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
