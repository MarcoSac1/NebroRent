<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 100)->nullable();
            $table->string('surname', length: 100)->nullable();
            $table->string('email', length: 255);
            $table->text('review_text');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
