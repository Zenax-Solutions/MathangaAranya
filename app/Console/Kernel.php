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
        // Daily reminder job at midnight
        $schedule->call(function () {
            try {
                $today = Carbon::now();

                Log::info('Running simplified reminder scheduler', [
                    'today' => $today->toDateString()
                ]);

                // JOB 1: Send reminders 3 days before next_reminder_date
                $reminderTriggerDate = $today->copy()->addDays(3);

                $usersForReminder = Community::whereDate('next_reminder_date', $reminderTriggerDate->toDateString())
                    ->where('payment_completed', false)
                    ->get();

                Log::info('Reminder job', [
                    'checking_date' => $reminderTriggerDate->toDateString(),
                    'users_found' => $usersForReminder->count()
                ]);

                foreach ($usersForReminder as $user) {
                    Log::info('Sending reminder email', [
                        'user_email' => $user->email,
                        'program_date' => $user->date,
                        'next_reminder_date' => $user->next_reminder_date,
                        'frequency' => $user->type
                    ]);

                    // Send reminder email with the next reminder date
                    Mail::to($user->email)->send(new RemindMail(
                        $user->id,
                        $user->first_name,
                        $user->last_name,
                        Carbon::parse($user->next_reminder_date) // Use next_reminder_date for email links
                    ));
                }

                // JOB 2: Reset payment status for users whose next_reminder_date is today (reminder date arrived)
                // This handles cases where users paid but need to be reset for next cycle tracking
                $usersForReset = Community::whereDate('next_reminder_date', $today->toDateString())
                    ->where('payment_completed', true)
                    ->get();

                Log::info('Payment status reset job', [
                    'checking_date' => $today->toDateString(),
                    'users_found' => $usersForReset->count()
                ]);

                foreach ($usersForReset as $user) {
                    // Only reset payment status - cycle advancement already handled by payment form
                    $user->update([
                        'payment_completed' => false, // Reset for next cycle
                        'amount' => 0 // Reset amount for next cycle
                    ]);

                    Log::info('Reset user payment status', [
                        'user_email' => $user->email,
                        'next_reminder_date' => $user->next_reminder_date,
                        'payment_status' => 'reset to false'
                    ]);
                }

                Log::info('Reminder scheduler completed successfully', [
                    'reminders_sent' => $usersForReminder->count(),
                    'payment_status_reset' => $usersForReset->count()
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
     * Calculate next date based on frequency
     */
    private function calculateNextDate(Carbon $currentDate, string $frequency): Carbon
    {
        switch (strtolower($frequency)) {
            case 'weekly':
                return $currentDate->copy()->addWeeks(1);
            case 'monthly':
                return $currentDate->copy()->addMonths(1);
            case 'yearly':
                return $currentDate->copy()->addYears(1);
            default:
                return $currentDate->copy()->addMonths(1); // Default to monthly
        }
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
