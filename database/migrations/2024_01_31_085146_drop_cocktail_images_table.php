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
        Schema::table('cocktail_images', function (Blueprint $table) {
            Schema::dropIfExists('cocktail_images');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cocktail_images', function (Blueprint $table) {
            $table->id();
            $table->string('cocktail_id');
            $table->string('object_type');
            $table->string('url');
            $table->timestamps();
        });
    }
};
