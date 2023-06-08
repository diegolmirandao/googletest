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
        Schema::create('product_detail_costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_detail_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('currency_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('cost_type_id')->constrained('product_cost_types')->onUpdate('cascade')->onDelete('restrict');
            $table->decimal('amount', 19, 6)->default(0);
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
        Schema::dropIfExists('product_detail_costs');
    }
};
