<?php

namespace App\Livewire;

use App\Models\Alms;
use App\Models\Community;
use App\Models\Donation;
use App\Models\Event;
use Livewire\Component;
use Carbon\Carbon;

class Dashboard extends Component
{
    public function render()
    {
        $today     = Carbon::today();
        $in3Days   = Carbon::today()->addDays(3);
        $thisMonth = Carbon::today()->startOfMonth();

        // Community stats
        $communityTotal        = Community::count();
        $communityToday        = Community::whereDate('date', $today)->count();
        $communityThisMonth    = Community::whereDate('date', '>=', $thisMonth)->count();
        $communityReminders    = Community::whereDate('next_reminder_date', '<=', $in3Days)
            ->whereDate('next_reminder_date', '>=', $today)
            ->orderBy('next_reminder_date')->limit(5)->get();
        $communityOverdue      = Community::whereDate('next_reminder_date', '<', $today)->count();

        // Alms stats
        $almsTotal          = Alms::count();
        $almsToday          = Alms::whereDate('date', $today)->count();
        $almsThisMonth      = Alms::whereDate('date', '>=', $thisMonth)->count();
        $almsReminders      = Alms::whereDate('next_reminder_date', '<=', $in3Days)
            ->whereDate('next_reminder_date', '>=', $today)
            ->orderBy('next_reminder_date')->limit(5)->get();
        $almsOverdue        = Alms::whereDate('next_reminder_date', '<', $today)->count();

        // Donation stats
        $donationTotal      = Donation::count();
        $donationToday      = Donation::whereDate('date', $today)->count();
        $donationThisMonth  = Donation::whereDate('date', '>=', $thisMonth)->count();

        // Upcoming events
        $upcomingEvents     = Event::whereDate('date', '>=', $today)->orderBy('date')->limit(3)->get();

        // Recent registrations (last 5 combined)
        $recentCommunity    = Community::latest()->limit(4)->get();
        $recentAlms         = Alms::latest()->limit(4)->get();

        return view('livewire.dashboard', compact(
            'communityTotal',
            'communityToday',
            'communityThisMonth',
            'communityReminders',
            'communityOverdue',
            'almsTotal',
            'almsToday',
            'almsThisMonth',
            'almsReminders',
            'almsOverdue',
            'donationTotal',
            'donationToday',
            'donationThisMonth',
            'upcomingEvents',
            'recentCommunity',
            'recentAlms',
            'today'
        ));
    }
}
