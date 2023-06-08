<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_detail_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_detail_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('warehouse_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('stock', 13, 5)->default(0);
            $table->decimal('reserved', 13, 5)->default(0);
            $table->decimal('minimum_stock', 13, 5)->default(0);
            $table->decimal('maximum_stock', 13, 5)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_detail_stocks');
    }
};
