<?php

namespace App\Livewire;

use App\Models\Donation;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class DonationForm extends Component
{

    
    use WithFileUploads;
    use LivewireAlert;

    public $donationAmount = '';
    public $paymentSlip = '';
    public $frequency = '';
    public $selectedDate = '';
    public $message = '';
    public $firstName = '';
    public $lastName = '';
    public $country = '';
    public $phoneNumber = '';
    public $email = '';
    public $address = '';

    public function render()
    {
        return view('livewire.donation-form');
    }

    public function submit()
    {

        $validated = $this->validate([
            'donationAmount' => 'required|numeric|min:0',
            'paymentSlip' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules for the uploaded file
            'frequency' => 'required|in:electricity_bill,water_bill,development,katina_pinkam',
            'selectedDate' => 'required|date',
            'message' => 'required|string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'country' => 'required|string',
            'phoneNumber' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
        ]);



        if ($validated) 
        {

      
            $data = Donation::create([

                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'email' => $this->email,
                'address' => $this->address,
                'phone_number' => $this->phoneNumber,
                'country' => $this->country,
                'date' => $this->selectedDate,
                'amount' => $this->donationAmount,
                'type' => $this->frequency,
                'description' => $this->message,
                'slip' => $this->paymentSlip->store('public'),
            ]);


            // Clear form fields after submission
          
            if($data)
            {
                
                $this->alert('success', 'Form submitted successfully.', [
                    'position' => 'center'
                ]);

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
