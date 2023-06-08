<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('currency_id')->default(1)->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->timestamp('paid_at')->useCurrent();
            $table->decimal('amount', 19, 6)->default(0);
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
        Schema::table('bill_payments', function (Blueprint $table) {
            $table->dropForeign(['bill_id']);
            $table->dropForeign(['payment_method_id']);
            $table->dropForeign(['currency_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
        Schema::dropIfExists('bill_payments');
    }
}
