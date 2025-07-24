<?php

namespace App\Console\Commands;

use App\Models\Community;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckDatabaseState extends Command
{
    protected $signature = 'check:database-state';
    protected $description = 'Check the current state of community records and next_reminder_date field';

    public function handle()
    {
        $this->info('🔍 DATABASE STATE CHECK');
        $this->info('======================');
        $this->line('');

        // Total records
        $total = Community::count();
        $this->info("📊 Total Community Records: {$total}");
        $this->line('');

        // Records with next_reminder_date
        $withNextReminder = Community::whereNotNull('next_reminder_date')->count();
        $withoutNextReminder = Community::whereNull('next_reminder_date')->count();

        $this->info("✅ Records WITH next_reminder_date: {$withNextReminder}");
        $this->info("❌ Records WITHOUT next_reminder_date: {$withoutNextReminder}");
        $this->line('');

        if ($withoutNextReminder > 0) {
            $this->warn("⚠️  {$withoutNextReminder} records need next_reminder_date populated!");
            $this->line('');
            
            // Show some examples
            $this->info("📋 Examples of records missing next_reminder_date:");
            $examples = Community::whereNull('next_reminder_date')->take(5)->get();
            
            foreach ($examples as $example) {
                $this->line("   ID: {$example->id} | {$example->first_name} {$example->last_name} | Date: {$example->date} | Type: {$example->type}");
            }
            
            $this->line('');
            $this->info("💡 To fix this, run: php artisan migrate:populate-next-reminder-dates");
        }

        // Show frequency breakdown
        $this->info('📈 BREAKDOWN BY FREQUENCY:');
        $frequencies = Community::selectRaw('type, COUNT(*) as count, 
                                           SUM(CASE WHEN next_reminder_date IS NOT NULL THEN 1 ELSE 0 END) as with_reminder')
                                ->groupBy('type')
                                ->get();

        foreach ($frequencies as $freq) {
            $percentage = $freq->count > 0 ? round(($freq->with_reminder / $freq->count) * 100, 1) : 0;
            $this->line("   {$freq->type}: {$freq->with_reminder}/{$freq->count} ({$percentage}%)");
        }

        $this->line('');

        // Show upcoming reminders
        $this->info('📅 UPCOMING REMINDERS (Next 7 days):');
        $upcomingReminders = Community::whereBetween('next_reminder_date', [
            Carbon::now()->toDateString(),
            Carbon::now()->addDays(7)->toDateString()
        ])->count();
        
        $this->line("   {$upcomingReminders} users have reminders due in the next 7 days");

        // Show payment status
        $this->info('💳 PAYMENT STATUS:');
        $paid = Community::where('payment_completed', true)->count();
        $unpaid = Community::where('payment_completed', false)->count();
        
        $this->line("   Paid: {$paid}");
        $this->line("   Unpaid: {$unpaid}");

        $this->line('');
        $this->info('🎯 SYSTEM READY: ' . ($withoutNextReminder == 0 ? 'YES ✅' : 'NO ❌'));

        return Command::SUCCESS;
    }
}
