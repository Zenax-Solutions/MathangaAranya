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
        Schema::table('communities', function (Blueprint $table) {
            $table->string('honorifics')->nullable()->after('last_name'); // Add honorifics field
            $table->text('note')->nullable()->after('slip'); // Add note field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->dropColumn('honorifics'); // Remove honorifics field
            $table->dropColumn('note'); // Remove note field
        });
    }
};
