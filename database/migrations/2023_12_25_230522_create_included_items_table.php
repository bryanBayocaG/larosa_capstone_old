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
        Schema::create('included_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_set_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('product_set_id')->references('id')->on('product_sets');
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('included_items');
    }
};