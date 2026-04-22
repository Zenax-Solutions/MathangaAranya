<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Alms extends Model
{
    use HasFactory;

    protected $fillable = [
        'honorifics',
        'first_name',
        'last_name',
        'email',
        'address',
        'phone_number',
        'whatsapp_number',
        'country',
        'date',
        'original_date',
        'next_reminder_date',
        'last_reminder_sent',
        'type',
        'meal_type',
        'description',
    ];

    protected $casts = [
        'date'               => 'date',
        'original_date'      => 'date',
        'next_reminder_date' => 'date',
        'last_reminder_sent' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($alms) {
            if (!$alms->next_reminder_date && $alms->date && $alms->type) {
                $alms->original_date      = $alms->date;
                $alms->next_reminder_date = self::calculateNextReminderDate(
                    Carbon::parse($alms->date),
                    $alms->type
                );
            }
        });
    }

    public static function calculateNextReminderDate(Carbon $programDate, string $frequency): Carbon
    {
        $today    = Carbon::now();
        $nextDate = $programDate->copy();

        // If date is in the future, use it as-is; otherwise advance until future
        while ($nextDate->lte($today)) {
            switch (strtolower($frequency)) {
                case 'weekly':
                    $nextDate->addWeeks(1);
                    break;
                case 'yearly':
                    $nextDate->addYears(1);
                    break;
                default: // monthly
                    $nextDate->addMonths(1);
                    break;
            }
        }

        return $nextDate;
    }

    public function advanceToNextCycle(): void
    {
        $this->next_reminder_date = self::calculateNextReminderDate(
            Carbon::parse($this->next_reminder_date),
            $this->type
        );
        $this->save();
    }

    /**
     * Return the salutation suffix based on honorifics.
     */
    public function getSalutationAttribute(): string
    {
        return match ($this->honorifics) {
            'Mrs'  => 'මහත්මියනි',
            'Miss' => 'මෙනවිය',
            default => 'මහතාණෙනි',
        };
    }

    /**
     * Return the meal label in Sinhala.
     */
    public function getMealLabelAttribute(): string
    {
        return $this->meal_type === 'lunch'
            ? 'දහවල් බුද්ධ පූජාව හා පුණ්‍යානුමෝදනාව (10.00 am)'
            : 'උදෑසන බුද්ධ පූජාව හා හීල් දානය (6.00 am)';
    }
}
