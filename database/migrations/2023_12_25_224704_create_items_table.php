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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_code', 10)->unique();
            $table->unsignedBigInteger('item_category_id');
            $table->unsignedBigInteger('color_id');
            $table->string('name');
            $table->string('productImage');
            $table->timestamps();

            $table->foreign('item_category_id')->references('id')->on('item_categories');
            $table->foreign('color_id')->references('id')->on('colors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
