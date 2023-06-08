<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('business_service_price_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->decimal('quantity', 13, 5)->default(1);
            $table->string('description')->nullable()->default(NULL);
            $table->timestamp('covers_from')->nullable()->default(NULL);
            $table->timestamp('covers_to')->nullable()->default(NULL);
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
        Schema::table('bill_services', function (Blueprint $table) {
            $table->dropForeign(['bill_id']);
            $table->dropForeign(['service_price_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
        Schema::dropIfExists('bill_services');
    }
}
