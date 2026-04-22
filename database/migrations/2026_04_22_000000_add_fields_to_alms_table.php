<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alms', function (Blueprint $table) {
            $table->string('honorifics')->nullable()->after('id');
            $table->string('whatsapp_number')->nullable()->after('phone_number');
            $table->string('meal_type')->default('breakfast')->after('type'); // breakfast or lunch
            $table->date('original_date')->nullable()->after('date');
            $table->date('next_reminder_date')->nullable()->after('original_date');
            $table->date('last_reminder_sent')->nullable()->after('next_reminder_date');
        });
    }

    public function down(): void
    {
        Schema::table('alms', function (Blueprint $table) {
            $table->dropColumn([
                'honorifics',
                'whatsapp_number',
                'meal_type',
                'original_date',
                'next_reminder_date',
                'last_reminder_sent',
            ]);
        });
    }
};
