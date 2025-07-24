<?php

namespace App\Console\Commands;

use App\Models\Community;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BulkAdminAdjustments extends Command
{
    protected $signature = 'admin:bulk-adjust {action} {--user-id=} {--days=} {--status=} {--dry-run}';
    protected $description = 'Bulk admin adjustments for community payment dates and status';

    public function handle()
    {
        $action = $this->argument('action');
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->info('🔍 DRY RUN MODE - No changes will be made');
            $this->line('');
        }

        switch ($action) {
            case 'extend-reminders':
                $this->extendReminders($dryRun);
                break;
            case 'reset-overdue':
                $this->resetOverduePayments($dryRun);
                break;
            case 'fix-missing-dates':
                $this->fixMissingReminderDates($dryRun);
                break;
            case 'list-overdue':
                $this->listOverdueUsers();
                break;
            default:
                $this->error('Invalid action. Available actions: extend-reminders, reset-overdue, fix-missing-dates, list-overdue');
                return 1;
        }

        return 0;
    }

    private function extendReminders($dryRun = false)
    {
        $days = $this->option('days') ?? 7;
        $userId = $this->option('user-id');

        $query = Community::where('payment_completed', false);

        if ($userId) {
            $query->where('id', $userId);
        }

        $users = $query->get();

        $this->info("🔧 Extending reminder dates by {$days} days for " . $users->count() . " users");
        $this->line('');

        foreach ($users as $user) {
            $oldDate = $user->next_reminder_date;
            $newDate = Carbon::parse($oldDate)->addDays($days);

            $this->line("👤 {$user->first_name} {$user->last_name} ({$user->email})");
            $this->line("   Old date: {$oldDate}");
            $this->line("   New date: {$newDate->toDateString()}");

            if (!$dryRun) {
                $user->update([
                    'next_reminder_date' => $newDate,
                    'reminder_notes' => "[BULK ADMIN ADJUSTMENT - " . now()->format('Y-m-d H:i:s') . "]\nReminder date extended by {$days} days\n\n" . ($user->reminder_notes ?? '')
                ]);
                $this->line("   ✅ Updated");
            } else {
                $this->line("   🔍 Would update (dry run)");
            }
            $this->line('');
        }
    }

    private function resetOverduePayments($dryRun = false)
    {
        $overdueUsers = Community::where('payment_completed', false)
            ->where('next_reminder_date', '<', now()->subDays(7))
            ->get();

        $this->info("🔄 Resetting " . $overdueUsers->count() . " overdue payments (more than 7 days late)");
        $this->line('');

        foreach ($overdueUsers as $user) {
            $this->line("👤 {$user->first_name} {$user->last_name} ({$user->email})");
            $this->line("   Overdue since: {$user->next_reminder_date}");

            if (!$dryRun) {
                // Calculate new reminder date based on frequency
                $newReminderDate = $this->calculateNextReminderDate($user);

                $user->update([
                    'next_reminder_date' => $newReminderDate,
                    'payment_completed' => false,
                    'amount' => 0,
                    'reminder_notes' => "[BULK ADMIN ADJUSTMENT - " . now()->format('Y-m-d H:i:s') . "]\nReset overdue payment and advanced to next cycle\nNew reminder date: {$newReminderDate}\n\n" . ($user->reminder_notes ?? '')
                ]);
                $this->line("   ✅ Reset to new cycle: {$newReminderDate}");
            } else {
                $newReminderDate = $this->calculateNextReminderDate($user);
                $this->line("   🔍 Would reset to: {$newReminderDate} (dry run)");
            }
            $this->line('');
        }
    }

    private function fixMissingReminderDates($dryRun = false)
    {
        $usersWithoutDates = Community::whereNull('next_reminder_date')
            ->orWhere('next_reminder_date', '')
            ->get();

        $this->info("🔧 Fixing " . $usersWithoutDates->count() . " users with missing reminder dates");
        $this->line('');

        foreach ($usersWithoutDates as $user) {
            $newReminderDate = $this->calculateNextReminderDate($user);

            $this->line("👤 {$user->first_name} {$user->last_name} ({$user->email})");
            $this->line("   Program date: {$user->date}");
            $this->line("   Calculated reminder date: {$newReminderDate}");

            if (!$dryRun) {
                $user->update([
                    'next_reminder_date' => $newReminderDate,
                    'reminder_notes' => "[BULK ADMIN ADJUSTMENT - " . now()->format('Y-m-d H:i:s') . "]\nGenerated missing next_reminder_date: {$newReminderDate}\n\n" . ($user->reminder_notes ?? '')
                ]);
                $this->line("   ✅ Updated");
            } else {
                $this->line("   🔍 Would update (dry run)");
            }
            $this->line('');
        }
    }

    private function listOverdueUsers()
    {
        $overdueUsers = Community::where('payment_completed', false)
            ->where('next_reminder_date', '<', now())
            ->orderBy('next_reminder_date', 'asc')
            ->get();

        $this->info("📋 Found " . $overdueUsers->count() . " overdue users");
        $this->line('');

        $this->table(
            ['Name', 'Email', 'Next Reminder Date', 'Days Overdue', 'Status'],
            $overdueUsers->map(function ($user) {
                $daysOverdue = now()->diffInDays(Carbon::parse($user->next_reminder_date));
                return [
                    $user->first_name . ' ' . $user->last_name,
                    $user->email,
                    $user->next_reminder_date,
                    $daysOverdue,
                    $user->payment_completed ? 'Completed' : 'Pending'
                ];
            })
        );
    }

    private function calculateNextReminderDate($user)
    {
        $programDate = Carbon::parse($user->date);
        $today = Carbon::now();

        switch ($user->type) {
            case 'weekly':
                while ($programDate <= $today) {
                    $programDate->addWeek();
                }
                return $programDate->toDateString();
            case 'yearly':
                while ($programDate <= $today) {
                    $programDate->addYear();
                }
                return $programDate->toDateString();
            default: // monthly
                while ($programDate <= $today) {
                    $programDate->addMonth();
                }
                return $programDate->toDateString();
        }
    }
}
