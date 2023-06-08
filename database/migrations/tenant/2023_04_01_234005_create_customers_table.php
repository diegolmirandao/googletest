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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_category_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('acquisition_channel_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('name');
            $table->string('identification_document')->unique();
            $table->string('email')->nullable()->default(NULL);
            $table->dateTime('birthday')->nullable()->default(NULL);
            $table->text('address')->nullable()->default(NULL);
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
        Schema::dropIfExists('customers');
    }
};
