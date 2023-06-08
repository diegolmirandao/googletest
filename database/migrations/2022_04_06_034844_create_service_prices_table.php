<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('service_price_type_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('billing_cycle_id')->default(1)->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('currency_id')->default(1)->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->boolean('status')->default(1);
            $table->integer('trial_period');
            $table->enum('trial_interval', ['days', 'weeks', 'months', 'trimesters', 'semesters', 'years']);  
            $table->integer('grace_period');
            $table->enum('grace_interval', ['days', 'weeks', 'months', 'trimesters', 'semesters', 'years']);  
            $table->integer('bill_generation_period');
            $table->enum('bill_generation_interval', ['days', 'weeks', 'months', 'trimesters', 'semesters', 'years']);  
            $table->decimal('amount', 19, 6)->default(0);
            $table->foreignId('created_by')->nullable()->default(NULL)->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('updated_by')->nullable()->default(NULL)->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_prices', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropForeign(['service_price_type_id']);
            $table->dropForeign(['currency_id']);
            $table->dropForeign(['billing_cycle_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
        Schema::dropIfExists('service_prices');
    }
}
