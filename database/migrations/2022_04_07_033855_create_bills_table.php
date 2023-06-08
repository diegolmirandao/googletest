<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('bill_status_id')->default(1)->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('currency_id')->default(1)->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->decimal('amount', 19, 6)->default(0);
            $table->decimal('paid_amount', 19, 6)->default(0);
            $table->timestamp('billed_at')->nullable()->useCurrent();
            $table->timestamp('expires_at')->nullable()->default(NULL);
            $table->timestamp('paid_at')->nullable()->default(NULL);
            $table->timestamp('canceled_at')->nullable()->default(NULL);
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
        Schema::table('bills', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
            $table->dropForeign(['bill_status_id']);
            $table->dropForeign(['currency_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
        Schema::dropIfExists('bills');
    }
}
