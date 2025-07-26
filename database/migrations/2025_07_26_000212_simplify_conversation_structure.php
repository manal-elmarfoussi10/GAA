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
        // Add thread_id to emails table
        Schema::table('emails', function (Blueprint $table) {
            $table->foreignId('thread_id')->nullable()->after('client_id');
        });
    
        // Create conversation threads table
        Schema::create('conversation_threads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('company_id')->constrained();
            $table->string('subject');
            $table->timestamps();
        });
    
        // Add foreign key constraint
        Schema::table('emails', function (Blueprint $table) {
            $table->foreign('thread_id')->references('id')->on('conversation_threads');
        });
    }
    
    public function down()
    {
        Schema::table('emails', function (Blueprint $table) {
            $table->dropForeign(['thread_id']);
            $table->dropColumn('thread_id');
        });
        
        Schema::dropIfExists('conversation_threads');
    }
};
