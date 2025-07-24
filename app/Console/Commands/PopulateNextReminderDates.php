<?php

namespace App\Console\Commands;

use App\Models\Community;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PopulateNextReminderDates extends Command
{
    protected $signature = 'migrate:populate-next-reminder-dates';
    protected $description = 'Populate next_reminder_date for existing community records';

    public function handle()
    {
        $this->info('🔄 POPULATING NEXT REMINDER DATES FOR EXISTING USERS');
        $this->info('=================================================');
        $this->line('');

        // Get all communities where next_reminder_date is null or empty
        $communities = Community::whereNull('next_reminder_date')->get();

        if ($communities->isEmpty()) {
            $this->info('✅ All community records already have next_reminder_date populated!');
            return Command::SUCCESS;
        }

        $this->info("Found {$communities->count()} records that need next_reminder_date populated");
        $this->line('');

        $updated = 0;
        $errors = 0;

        foreach ($communities as $community) {
            try {
                // Use the existing date field as program_date
                $programDate = Carbon::parse($community->date);
                $frequency = $community->type ?? 'monthly';

                // Calculate next_reminder_date using the same logic as the model
                $nextReminderDate = $this->calculateNextReminderDate($programDate, $frequency);

                // Update the record
                $community->update(['next_reminder_date' => $nextReminderDate]);

                $this->line("✅ Updated ID {$community->id}: {$community->first_name} {$community->last_name}");
                $this->line("   Program Date: {$programDate->format('Y-m-d')}");
                $this->line("   Next Reminder: {$nextReminderDate->format('Y-m-d')} ({$frequency})");
                $this->line('');

                $updated++;

            } catch (\Exception $e) {
                $this->error("❌ Error updating ID {$community->id}: {$e->getMessage()}");
                $errors++;
                
                Log::error('Failed to populate next_reminder_date', [
                    'community_id' => $community->id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        $this->line('');
        $this->info('📊 SUMMARY:');
        $this->info("✅ Successfully updated: {$updated} records");
        if ($errors > 0) {
            $this->error("❌ Errors encountered: {$errors} records");
        }
        $this->line('');

        // Show some statistics
        $this->info('📈 STATISTICS BY FREQUENCY:');
        $stats = Community::selectRaw('type, COUNT(*) as count')
            ->whereNotNull('next_reminder_date')
            ->groupBy('type')
            ->get();

        foreach ($stats as $stat) {
            $this->line("   {$stat->type}: {$stat->count} users");
        }

        $this->line('');
        $this->info('🎯 NEXT STEPS:');
        $this->line('1. Verify the populated dates look correct in your admin panel');
        $this->line('2. Test the reminder system with a few users');
        $this->line('3. Monitor the scheduler logs for any issues');

        return Command::SUCCESS;
    }

    /**
     * Calculate next reminder date based on program date and frequency
     * This matches the logic in Community model
     */
    private function calculateNextReminderDate(Carbon $programDate, string $frequency): Carbon
    {
        $today = Carbon::now();

        // If program date is in the future, next reminder date is the same
        if ($programDate->isAfter($today)) {
            return $programDate->copy();
        }

        // If program date is in the past, calculate the next occurrence
        $nextDate = $programDate->copy();

        while ($nextDate->isPast()) {
            switch (strtolower($frequency)) {
                case 'weekly':
                    $nextDate->addWeeks(1);
                    break;
                case 'monthly':
                    $nextDate->addMonths(1);
                    break;
                case 'yearly':
                    $nextDate->addYears(1);
                    break;
                default:
                    $nextDate->addMonths(1); // Default to monthly
                    break;
            }
        }

        return $nextDate;
    }
}
