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

    }

    public function render()
    {
        return view('livewire.contribution-form-payment');
    }


    public function submit()
    {

        $validated = $this->validate([
            'donationAmount' => 'required|numeric|min:0',
            'paymentSlip' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);



        if ($validated)
        {
            $data = Community::find($this->id)->update([
                'date' => $this->date,
                'amount' => $this->donationAmount,
                'slip' => $this->paymentSlip->store('public'),
            ]);

            // Clear form fields after submission
          
            if($data)
            {
                
                $this->alert('success', 'Form submitted successfully.', [
                    'position' => 'center'
                ]);

                //Mail::to($this->email)->send(new ThankyouMail($validated));

                return redirect('/thank-you')->with('message', 'done');
            }
        }  
     
        else
        {
            $this->alert('warning', 'Please fill all the fields !', [
                'position' => 'center'
            ]);

        }

    }

}

