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
        Schema::create('rent_infos', function (Blueprint $table) {
            $table->id();
            $table->string('transac_code', 10);
            $table->date('event_date');
            $table->date('return_date')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact_num');
            $table->string('address');
            $table->string('rent_type');
            $table->decimal('totalPrice', 10, 2);
            $table->decimal('balance', 10, 2)->nullable();
            $table->string('status')->default('Renting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_infos');
    }
};
