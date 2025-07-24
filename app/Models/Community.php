<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Community extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'address',
        'phone_number',
        'country',
        'date',
        'original_date',
        'current_reminder_date',
        'next_reminder_date',
        'last_reminder_sent',
        'payment_completed',
        'payment_date',
        'amount',
        'type',
        'description',
        'slip',
        'honorifics',
        'note',
        'reminder_notes'
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
        'original_date' => 'date',
        'current_reminder_date' => 'date',
        'next_reminder_date' => 'date',
        'last_reminder_sent' => 'date',
        'payment_date' => 'date',
        'payment_completed' => 'boolean',
    ];

    /**
     * Boot method to handle automatic next_reminder_date calculation
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($community) {
            // Automatically calculate next_reminder_date if not provided
            if (!$community->next_reminder_date && $community->date && $community->type) {
                $community->next_reminder_date = self::calculateNextReminderDate(
                    Carbon::parse($community->date),
                    $community->type
                );
            }
        });
    }

    /**
     * Calculate next reminder date based on program date and frequency
     * Logic:
     * - If program date is FUTURE: next_reminder_date = program_date (same value)
     * - If program date is PAST: next_reminder_date = calculate next cycle
     */
    public static function calculateNextReminderDate(Carbon $programDate, string $frequency): Carbon
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
