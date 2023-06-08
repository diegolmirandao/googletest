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
        Schema::create('sale_order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_order_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_detail_price_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('measurement_unit_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('status_id')->default(1)->constrained('sale_order_statuses')->onUpdate('cascade')->onDelete('restrict');
            $table->decimal('quantity', 13, 5)->default(1);
            $table->decimal('billed_quantity', 13, 5)->default(0);
            $table->decimal('canceled_quantity', 13, 5)->default(0);
            $table->decimal('discount', 25, 10)->default(0);
            $table->string('code');
            $table->string('name');
            $table->boolean('taxed')->default('1');
            $table->decimal('tax', 9, 6)->default(0);
            $table->decimal('percentage_taxed', 9, 6)->default(100);
            $table->text('comments')->nullable()->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_order_products');
    }
};
