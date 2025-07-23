<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\RemindMail;
use App\Models\Community;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TestReminderScheduler extends Command
{
    protected $signature = 'reminder:test';
    protected $description = 'Test the reminder scheduler logic manually';

    public function handle()
    {
        $this->info('=== Testing Reminder Scheduler ===');

        try {
            $today = Carbon::now();
            $reminderDate = $today->copy()->addDays(3); // Send reminder 3 days before the due date

            $this->info("Today: {$today->toDateString()}");
            $this->info("Reminder trigger date: {$reminderDate->toDateString()}");

            $users = Community::all();
            $emailsSent = 0;

            $this->info("Checking {$users->count()} community members...");

            foreach ($users as $user) {
                $originalDate = $user->date->copy(); // Use copy to avoid modifying the original
                $reminderFrequency = $user->type;
                $nextReminderDate = null;

                // Calculate the next reminder date based on frequency
                if ($reminderFrequency === 'monthly') {
                    // For monthly: find the next occurrence of the same day of month
                    $nextReminderDate = $originalDate->copy();

                    while ($nextReminderDate->lte($today)) {
                        $nextReminderDate->addMonth();
                    }
                } elseif ($reminderFrequency === 'yearly') {
                    // For yearly: find the next occurrence of the same month and day
                    $nextReminderDate = Carbon::create(
                        $today->year,
                        $originalDate->month,
                        $originalDate->day
                    );

                    // If this year's date has already passed, move to next year
                    if ($nextReminderDate->lte($today)) {
                        $nextReminderDate->addYear();
                    }
                }

                // Check if we should send a reminder (3 days before the due date)
                if ($nextReminderDate && $nextReminderDate->format('Y-m-d') == $reminderDate->format('Y-m-d')) {

                    $this->info("📧 Sending reminder to: {$user->email}");
                    $this->info("   Next reminder date: {$nextReminderDate->toDateString()}");
                    $this->info("   Frequency: {$reminderFrequency}");

                    // Reset amount to 0 as they mentioned in original code
                    $user->update(['amount' => 0]);

                    // Send the reminder email
                    Mail::to($user->email)->send(new RemindMail(
                        $user->id,
                        $user->first_name,
                        $user->last_name,
                        $nextReminderDate
                    ));

                    $emailsSent++;
                }
            }

            $this->info("✓ Scheduler test completed!");
            $this->info("Total users checked: {$users->count()}");
            $this->info("Emails sent: {$emailsSent}");

            if ($emailsSent === 0) {
                $this->warn("No reminders were sent. This is normal if no users have dates that trigger 3 days from today.");
            }
        } catch (\Exception $e) {
            $this->error('Reminder scheduler test failed!');
            $this->error("Error: {$e->getMessage()}");
            Log::error('Reminder scheduler test failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
