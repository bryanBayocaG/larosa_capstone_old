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
        Schema::table('rented_items', function (Blueprint $table) {
            $table->unsignedBigInteger('product_set_id')->nullable()->change();
            $table->unsignedBigInteger('single_item_id')->nullable();

            $table->foreign('single_item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rented_items', function (Blueprint $table) {
            //
        });
    }
};
