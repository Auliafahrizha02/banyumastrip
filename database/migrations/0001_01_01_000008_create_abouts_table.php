<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g., "Tentang Banyumas"
            $table->text('description'); // Long description
            $table->text('image')->nullable(); // Image URL or path
            $table->string('city'); // City name (e.g., "Banyumas")
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
