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
        Schema::create('variant_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->foreignId('equivalent_variant_option_id')->nullable()->default(NULL)->constrained('variant_options')->onUpdate('cascade')->onDelete('restrict');
            $table->decimal('equivalent_amount', 13, 5)->nullable()->default(NULL);
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
        Schema::dropIfExists('variant_options');
    }
};
