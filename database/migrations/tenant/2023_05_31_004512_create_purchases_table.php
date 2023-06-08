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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('currency_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('establishment_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('warehouse_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('document_type_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('payment_term_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->decimal('amount', 19, 6)->default(0);
            $table->decimal('paid_amount', 19, 6)->default(0);
            $table->dateTime('purchased_at');
            $table->dateTime('expires_at')->nullable()->default(NULL);
            $table->dateTime('paid_at')->nullable()->default(NULL);
            $table->string('name');
            $table->string('identification_document');
            $table->string('email')->nullable()->default(NULL);
            $table->string('phone')->nullable()->default(NULL);
            $table->text('address')->nullable()->default(NULL);
            $table->text('comments')->nullable()->default(NULL);
            $table->foreignId('created_by')->nullable()->default(NULL)->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('updated_by')->nullable()->default(NULL)->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
