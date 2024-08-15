<?php

namespace App\Livewire;

use App\Models\Community;
use App\Models\Donation;
use Livewire\Component;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $donationCount = 0, $totalDonationCount = 0;

    public $todayDailyContributions = 0, $todayDailyContributionsCount = 0 ;

    public $clients;

    public function render()
    {

        $this->donationCount = Donation::where('date',Carbon::createFromFormat('Y-m-d', Carbon::now()->format('Y-m-d'))->startOfDay())->count();

        $this->totalDonationCount = Donation::all()->count();


        $this->todayDailyContributions = Community::where('date', Carbon::createFromFormat('Y-m-d', Carbon::now()->format('Y-m-d'))->startOfDay())->count();

        $this->todayDailyContributionsCount = Community::all()->count();

        $this->clients = Community::where('date',Carbon::createFromFormat('Y-m-d', Carbon::now()->format('Y-m-d'))->startOfDay())->limit(2)->get();

        return view('livewire.dashboard');
    }
}
