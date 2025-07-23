<?php

namespace App\Console;

use App\Mail\RemindMail;
use App\Models\Community;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            try {
                $today = Carbon::now();
                $reminderDate = $today->copy()->addDays(3); // Send reminder 3 days before the due date

                Log::info('Running reminder scheduler', [
                    'today' => $today->toDateString(),
                    'reminder_trigger_date' => $reminderDate->toDateString()
                ]);

                $users = Community::all();
                $emailsSent = 0;

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

                        Log::info('Sending reminder email', [
                            'user_email' => $user->email,
                            'next_reminder_date' => $nextReminderDate->toDateString(),
                            'frequency' => $reminderFrequency
                        ]);

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

                Log::info('Reminder scheduler completed', [
                    'total_users_checked' => $users->count(),
                    'emails_sent' => $emailsSent
                ]);
            } catch (\Exception $e) {
                Log::error('Reminder scheduler failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
