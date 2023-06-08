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
        Schema::create('service_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('feature_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->integer('quantity')->default(1);
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
        Schema::table('service_features', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropForeign(['feature_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
        Schema::dropIfExists('service_features');
    }
};
