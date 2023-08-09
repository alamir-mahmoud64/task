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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consumer_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('unit_price',12,2);
            $table->decimal('vat_percentage',12,2);
            $table->decimal('vat_amount',12,2);
            $table->decimal('unit_price_with_vat',12,2);
            $table->decimal('total_price',12,2);
            $table->decimal('total_vat_amount',12,2);
            $table->decimal('total_price_with_vat',12,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
