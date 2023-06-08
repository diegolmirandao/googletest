<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessServicePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_service_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('service_price_id')->default(1)->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('business_service_status_id')->default(1)->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->decimal('quantity', 13, 5)->default(1);
            $table->timestamp('last_expiration_at')->nullable()->default(NULL);
            $table->timestamp('next_expiration_at')->nullable()->default(NULL);
            $table->timestamp('activated_at')->nullable()->default(NULL);
            $table->timestamp('suspended_at')->nullable()->default(NULL);
            $table->timestamp('canceled_at')->nullable()->default(NULL);
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
        Schema::table('business_service_prices', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
            $table->dropForeign(['service_price_id']);
            $table->dropForeign(['business_service_status_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
        Schema::dropIfExists('business_service_prices');
    }
}
