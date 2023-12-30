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
        Schema::create('rented_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rent_info_id');
            $table->unsignedBigInteger('product_set_id');
            $table->decimal('pricing', 10, 2);
            $table->timestamps();

            $table->foreign('rent_info_id')->references('id')->on('rent_infos');
            $table->foreign('product_set_id')->references('id')->on('product_sets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rented_items');
    }
};
