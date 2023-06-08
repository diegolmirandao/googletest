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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id')->constrained('product_subcategories')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('brand_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('type_id')->constrained('product_types')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('measurement_unit_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('name');
            $table->text('description')->nullable()->default(NULL);
            $table->boolean('status')->default('1');
            $table->boolean('taxed')->default('1');
            $table->decimal('tax', 9, 6)->default(0);
            $table->decimal('percentage_taxed', 9, 6)->default(100);
            $table->foreignId('created_by')->nullable()->default(NULL)->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('updated_by')->nullable()->default(NULL)->constrained('users')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('products');
    }
};
