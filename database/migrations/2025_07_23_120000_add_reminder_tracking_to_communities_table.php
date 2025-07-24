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
            // Add new columns for proper reminder tracking
            $table->date('original_date')->nullable()->after('date'); // Store the original commitment date
            $table->date('current_reminder_date')->nullable()->after('original_date'); // Current reminder cycle date
            $table->date('next_reminder_date')->nullable()->after('current_reminder_date'); // Next reminder date
            $table->date('last_reminder_sent')->nullable()->after('next_reminder_date'); // Track when last reminder was sent
            $table->boolean('payment_completed')->default(false)->after('last_reminder_sent'); // Track if current payment is done
            $table->text('reminder_notes')->nullable()->after('payment_completed'); // Optional notes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->dropColumn([
                'original_date',
                'current_reminder_date',
                'next_reminder_date',
                'last_reminder_sent',
                'payment_completed',
                'reminder_notes'
            ]);
        });
    }
};
