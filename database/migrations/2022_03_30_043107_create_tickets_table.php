<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_department_id')->default(1)->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('ticket_status_id')->default(1)->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('business_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->timestamp('generated_at')->useCurrent();
            $table->text('message');
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
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['ticket_department_id']);
            $table->dropForeign(['ticket_status_id']);
            $table->dropForeign(['business_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
        Schema::dropIfExists('tickets');
    }
}
