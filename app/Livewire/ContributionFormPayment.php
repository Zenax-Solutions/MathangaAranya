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

    public $id,$date;


    public function mount($id,$date)
    {
        $this->id = $id;
        $this->date = $date;

        $community = Community::find($this->id);

        if ($community) {
            if($community->date->isPast())
            {
                $this->alert('warning', 'You have missed the deadline for this contribution!', [
                    'position' => 'center'
                ]);
            }
            else
            {
                $this->alert('info', 'You have not missed the deadline for this contribution!', [
                    'position' => 'center'
                ]);
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
                // Determine the new date based on the user type
                $currentDate =  $community->date;
                $reminderFrequency = $community->type;
                
                if ($reminderFrequency === 'monthly') {
                    $nextReminderDate = $currentDate->addMonth();
                } elseif ($reminderFrequency === 'yearly') {
                    $nextReminderDate = $currentDate->addYear();
                } else {
                    $nextReminderDate = $currentDate;
                }
    
                $community->update([
                    'date' => $nextReminderDate, // Update the date based on the user type
                    'amount' => $this->donationAmount,
                    'slip' => '',
                ]);
    
                // Clear form fields after submission
                $this->reset(); // Optionally reset form fields
    
                $this->alert('success', 'Form submitted successfully.', [
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

}

