<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// In the migration file
public function up()
{
    Schema::table('emails', function (Blueprint $table) {
        $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('emails', function (Blueprint $table) {
        $table->dropForeign(['company_id']);
        $table->dropColumn('company_id');
    });
}
};
