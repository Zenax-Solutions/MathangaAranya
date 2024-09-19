<?php

namespace App\Console;

use App\Mail\RemindMail;
use App\Models\Community;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use Mail;
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

            $today = Carbon::now();
            $users = Community::all();

            foreach ($users as $user) {
                // Calculate the reminder date based on the user's settings
                $reminderDate = $user->date;
                $reminderFrequency = $user->type;

                // Check if the reminder date is valid
                if ($reminderFrequency === 'monthly') {

                    if ($reminderDate->isPast()) {

                        // Monthly reminders
                        $nextReminderDate = $reminderDate->addMonth();
                    } else {
                        $nextReminderDate = $reminderDate;
                    }
                } elseif ($reminderFrequency === 'yearly') {

                    if ($reminderDate->isPast()) {

                        // Yearly reminders
                        $nextReminderDate = $today->copy()->addYear();
                    } else {
                        $nextReminderDate = $reminderDate;
                    }
                }

                if ($nextReminderDate->format('Y-m-d') == Carbon::now()->addDays(3)->toDateString()) {

                    Mail::to($user->email)->send(new RemindMail($user->id, $user->first_name, $user->last_name, $nextReminderDate));
                }
            }
        })->everyMinute();

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
