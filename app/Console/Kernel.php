<?php

namespace App\Console;

use App\Mail\RemindMail;
use App\Mail\AlmsRemindMail;
use App\Models\Community;
use App\Models\Alms;
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

                // JOB 1: Send reminders up to 3 days before next_reminder_date
                // Upper bound: next_reminder_date is within 3 days (not too early)
                // No lower bound: also catches overdue reminders that failed in previous runs
                // Overdue cutoff: ignore reminders more than 30 days past due (stale data)
                $reminderWindowEnd     = $today->copy()->addDays(3)->toDateString();
                $overdueCutoff         = $today->copy()->subDays(30)->toDateString();

                $usersForReminder = Community::whereDate('next_reminder_date', '<=', $reminderWindowEnd)
                    ->whereDate('next_reminder_date', '>=', $overdueCutoff)
                    ->where(function ($query) {
                        // Send only once per cycle: last_reminder_sent is null (never sent)
                        // OR last_reminder_sent is before next_reminder_date (paid and cycled forward)
                        $query->whereNull('last_reminder_sent')
                            ->orWhereColumn('last_reminder_sent', '<', 'next_reminder_date');
                    })
                    ->get();

                Log::info('Reminder job', [
                    'checking_date_to'   => $reminderWindowEnd,
                    'overdue_cutoff'     => $overdueCutoff,
                    'users_found' => $usersForReminder->count()
                ]);

                $remindersSent = 0;
                foreach ($usersForReminder as $user) {
                    try {
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
                            Carbon::parse($user->next_reminder_date)
                        ));

                        // Store next_reminder_date (not today) so the dedup check
                        // last_reminder_sent < next_reminder_date becomes FALSE → won't resend
                        // When user pays and next_reminder_date advances, the condition becomes
                        // TRUE again → next cycle reminder will fire correctly
                        $user->update(['last_reminder_sent' => $user->next_reminder_date->toDateString()]);
                        $remindersSent++;
                    } catch (\Exception $e) {
                        Log::error('Failed to send reminder email', [
                            'user_email' => $user->email,
                            'error' => $e->getMessage(),
                        ]);
                        // Continue to the next user — do not abort the batch
                    }
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
                    'reminders_sent' => $remindersSent,
                    'reminders_failed' => $usersForReminder->count() - $remindersSent,
                    'payment_status_reset' => $usersForReset->count()
                ]);
            } catch (\Exception $e) {
                Log::error('Reminder scheduler failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        })->daily();

        // Daily Alms reminder job
        $schedule->call(function () {
            try {
                $today         = Carbon::now();
                $windowEnd     = $today->copy()->addDays(3)->toDateString();
                $overdueCutoff = $today->copy()->subDays(30)->toDateString();

                Log::info('Running Daily Alms reminder scheduler', [
                    'today' => $today->toDateString()
                ]);

                // JOB A: Send Sinhala reminder emails for upcoming dana dates
                $almsForReminder = Alms::whereDate('next_reminder_date', '<=', $windowEnd)
                    ->whereDate('next_reminder_date', '>=', $overdueCutoff)
                    ->where(function ($query) {
                        $query->whereNull('last_reminder_sent')
                            ->orWhereColumn('last_reminder_sent', '<', 'next_reminder_date');
                    })
                    ->get();

                Log::info('Alms reminder job', [
                    'window_end'     => $windowEnd,
                    'overdue_cutoff' => $overdueCutoff,
                    'users_found'    => $almsForReminder->count(),
                ]);

                $sent = 0;
                foreach ($almsForReminder as $alms) {
                    try {
                        Mail::to($alms->email)->send(new AlmsRemindMail($alms));
                        $alms->update(['last_reminder_sent' => $alms->next_reminder_date->toDateString()]);
                        $sent++;
                        Log::info('Alms reminder sent', ['email' => $alms->email, 'dana_date' => $alms->next_reminder_date]);
                    } catch (\Exception $e) {
                        Log::error('Failed to send Alms reminder', [
                            'email' => $alms->email,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }

                // JOB B: Advance next_reminder_date for past-due alms registrations
                // (no payment form for alms — scheduler advances the cycle automatically)
                $almsOverdue = Alms::whereDate('next_reminder_date', '<', $today->toDateString())
                    ->whereColumn('last_reminder_sent', '>=', 'next_reminder_date') // reminder was sent
                    ->get();

                foreach ($almsOverdue as $alms) {
                    $alms->advanceToNextCycle();
                    Log::info('Alms cycle advanced', [
                        'email'             => $alms->email,
                        'new_reminder_date' => $alms->next_reminder_date,
                    ]);
                }

                Log::info('Daily Alms scheduler completed', [
                    'reminders_sent'   => $sent,
                    'reminders_failed' => $almsForReminder->count() - $sent,
                    'cycles_advanced'  => $almsOverdue->count(),
                ]);
            } catch (\Exception $e) {
                Log::error('Daily Alms scheduler failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
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
