<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('emails', function (Blueprint $table) {
            // Remove the old foreign key
            $table->dropForeign(['conversation_id']);
    
            // Add new foreign key pointing to conversation_threads table
            $table->foreign('conversation_id')
                  ->references('id')
                  ->on('conversation_threads')
                  ->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('emails', function (Blueprint $table) {
            $table->dropForeign(['conversation_id']);
            
            // Recreate the old constraint (if needed for rollback)
            $table->foreign('conversation_id')
                  ->references('id')
                  ->on('conversations')
                  ->onDelete('cascade');
        });
    }
};
