<?php

namespace App\Livewire;

use App\Mail\AlmsWelcomeMail;
use App\Models\Alms;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AlmsForm extends Component
{
    use LivewireAlert;

    public $title        = '';
    public $firstName    = '';
    public $lastName     = '';
    public $email        = '';
    public $phoneNumber  = '';
    public $whatsappNumber = '';
    public $country      = '';
    public $address      = '';
    public $selectedDate = '';
    public $frequency    = '';
    public $mealType     = '';
    public $description  = '';

    public function render()
    {
        return view('livewire.alms-form');
    }

    public function submit()
    {
        $this->validate([
            'title'          => 'required|in:Mr,Mrs,Miss',
            'firstName'      => 'required|string|max:100',
            'lastName'       => 'required|string|max:100',
            'email'          => 'required|email',
            'phoneNumber'    => 'required|string',
            'whatsappNumber' => 'required|string',
            'country'        => 'required|string',
            'address'        => 'required|string',
            'selectedDate'   => 'required|date',
            'frequency'      => 'required|in:monthly,yearly',
            'mealType'       => 'required|in:breakfast,lunch',
            'description'    => 'required|string',
        ]);

        $alms = Alms::create([
            'honorifics'      => $this->title,
            'first_name'      => $this->firstName,
            'last_name'       => $this->lastName,
            'email'           => $this->email,
            'phone_number'    => $this->phoneNumber,
            'whatsapp_number' => $this->whatsappNumber,
            'country'         => $this->country,
            'address'         => $this->address,
            'date'            => $this->selectedDate,
            'type'            => $this->frequency,
            'meal_type'       => $this->mealType,
            'description'     => $this->description,
        ]);

        try {
            Mail::to($this->email)->send(new AlmsWelcomeMail($alms));
        } catch (\Exception $e) {
            // Log but don't block the user — registration already saved
            \Log::error('Failed to send Alms welcome email', [
                'email' => $this->email,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect('/thank-you-alms')->with('message', 'done');
    }
}
