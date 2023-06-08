<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('generated_at')->nullable()->useCurrent();
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
        Schema::table('ticket_replies', function (Blueprint $table) {
            $table->dropForeign(['ticket_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
        Schema::dropIfExists('ticket_replies');
    }
}
