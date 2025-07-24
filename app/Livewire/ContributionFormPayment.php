<?php

namespace App\Livewire;

use App\Mail\ThankyouMail;
use App\Models\Community;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Mail;


class ContributionFormPayment extends Component
{

    use WithFileUploads;
    use LivewireAlert;

    public $donationAmount = '';
    public $paymentSlip = '';

    public $id, $date;


    public function mount($id, $date)
    {
        $this->id = $id;
        $this->date = $date;

        $community = Community::find($this->id);

        if ($community) {
            // Parse the date from the URL (this should be the next_reminder_date)
            $requestDate = Carbon::parse($this->date);
            $today = Carbon::now();

            // Get user's next reminder date
            $nextReminderDate = Carbon::parse($community->next_reminder_date);

            // Check if payment is already completed
            if ($community->payment_completed) {
                return redirect('/')->with([
                    'popup_type' => 'success',
                    'popup_title' => 'Already Paid!',
                    'popup_message' => 'Your payment has already been completed for this cycle. Thank you for your contribution!'
                ]);
            }

            // Security check: Validate the URL date matches the user's next_reminder_date
            if (!$requestDate->equalTo($nextReminderDate)) {
                return redirect('/')->with([
                    'popup_type' => 'error',
                    'popup_title' => 'Invalid Link!',
                    'popup_message' => 'This payment link is invalid or expired. Please use the link from your latest reminder email.'
                ]);
            }

            // Calculate timing and show appropriate message
            $daysUntilReminder = $today->diffInDays($nextReminderDate, false);

            // Check if user missed the payment deadline (more than 3 days late)
            if ($daysUntilReminder < -3) {
                $daysPastReminder = abs($daysUntilReminder);
                return redirect('/')->with([
                    'popup_type' => 'error',
                    'popup_title' => 'Payment Deadline Missed!',
                    'popup_message' => "You missed the payment deadline! Your reminder date was {$nextReminderDate->format('Y-m-d')} ({$daysPastReminder} days ago). Please wait for your next reminder email."
                ]);
            }

            // Show timing alerts for valid payment window
            if ($daysUntilReminder > 3) {
                // Early payment - more than 3 days before reminder date
                $this->alert('warning', "You are paying early! Your reminder date is {$nextReminderDate->format('Y-m-d')} ({$daysUntilReminder} days from now).", [
                    'position' => 'center'
                ]);
                $this->alert('warning', "You are paying early! Your reminder date is {$nextReminderDate->format('Y-m-d')} ({$daysUntilReminder} days from now).", [
                    'position' => 'center'
                ]);
            } else {
                // On time - within 3 days of reminder date
                if ($daysUntilReminder > 0) {
                    $this->alert('success', "Perfect timing! Your reminder date is {$nextReminderDate->format('Y-m-d')} (in {$daysUntilReminder} days).", [
                        'position' => 'center'
                    ]);
                } elseif ($daysUntilReminder < 0) {
                    $daysPastReminder = abs($daysUntilReminder);
                    $this->alert('info', "You can still pay! Your reminder date was {$nextReminderDate->format('Y-m-d')} ({$daysPastReminder} days ago).", [
                        'position' => 'center'
                    ]);
                } else {
                    $this->alert('success', "Today is your reminder date! Perfect timing for payment.", [
                        'position' => 'center'
                    ]);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.contribution-form-payment');
    }


    public function submit()
    {
        $validated = $this->validate([
            'donationAmount' => 'required|numeric|min:0',
            // 'paymentSlip' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validated) {
            $community = Community::find($this->id);

            if ($community) {
                // Check if payment is already completed (double-check)
                if ($community->payment_completed) {
                    $this->alert('warning', 'Payment already completed for this cycle!', [
                        'position' => 'center'
                    ]);
                    return;
                }

                // Process the payment - update cycle dates
                $currentNextReminderDate = Carbon::parse($community->next_reminder_date);

                // Calculate next reminder date based on frequency
                $newNextReminderDate = $this->calculateNextDate($currentNextReminderDate, $community->type);

                $community->update([
                    'amount' => $this->donationAmount,
                    'payment_completed' => true, // Mark current cycle as paid
                    'date' => $currentNextReminderDate, // Update program date to current reminder date
                    'next_reminder_date' => $newNextReminderDate, // Set next cycle reminder date
                    'slip' => ''
                ]);

                // Important: The payment_completed will be reset to false by the scheduler
                // when the next_reminder_date arrives, preparing for the next cycle

                // Clear form fields after submission
                $this->reset();

                $this->alert('success', 'Payment submitted successfully! You will receive reminders for your next cycle automatically.', [
                    'position' => 'center'
                ]);

                return redirect('/thank-you')->with('message', 'done');
            }
        } else {
            $this->alert('warning', 'Please fill all the fields!', [
                'position' => 'center'
            ]);
        }
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
}
