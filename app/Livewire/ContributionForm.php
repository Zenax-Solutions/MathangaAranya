<?php

namespace App\Livewire;

use App\Mail\ThankyouMail;
use App\Models\Community;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Mail;


class ContributionForm extends Component
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

    public $disableDate;

    public function render()
    {
       
        $records = Community::all();

        $groupedRecords = [];

        foreach($records as $record)
        {
            $date = $record->date->format('Y-m-d'); // Assuming date_field is a DateTime instance
            $groupedRecords[$date][] = $record;

        }

        $filteredRecords = array_filter($groupedRecords, function ($records) {
            return count($records) === 2;
        });
        
        $extractedData = [];

        foreach ($filteredRecords as $date => $records) {
          
                $extractedData[] = $date; // Convert each record to an array
        
        }

        $this->disableDate =  $extractedData;


        return view('livewire.contribution-form');
    }


    public function submit()
    {

        $validated = $this->validate([
            //'donationAmount' => 'required|numeric|min:0',
            //'paymentSlip' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules for the uploaded file
            'frequency' => 'required|in:monthly,yearly',
            'selectedDate' => 'required|date',
            'message' => 'required|string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'country' => 'required|string',
            'phoneNumber' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
        ]);



        if ($validated) {

        $matchDate = Community::where('date', Carbon::createFromFormat('Y-m-d', $this->selectedDate)->startOfDay())->count();
        
        if($matchDate < 2)
        {
            $data = Community::create([

                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'email' => $this->email,
                'address' => $this->address,
                'phone_number' => $this->phoneNumber,
                'country' => $this->country,
                'date' => $this->selectedDate,
                //'amount' => $this->donationAmount,
                'type' => $this->frequency,
                'description' => $this->message,
                //'slip' => $this->paymentSlip->store('public'),
            ]);


            // Clear form fields after submission
          
            if($data)
            {
                
                $this->alert('success', 'Form submitted successfully.', [
                    'position' => 'center'
                ]);

                Mail::to($this->email)->send(new ThankyouMail($validated));

                return redirect('/thank-you')->with('message', 'done');
            }
        }
        else
        {
            $this->alert('info', 'Please select the different date !', [
                'position' => 'center'
            ]);
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
