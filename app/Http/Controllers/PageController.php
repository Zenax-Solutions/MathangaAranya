<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Community;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Project;
use App\Models\Speech;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PageController extends Controller
{

    public function index()
    {
        Paginator::useBootstrap();

        $gallery = Gallery::latest()->get();

        $events = Event::latest()->limit(3)->get();

        $speeaches = Speech::where('publish', true);

        $books = Speech::where('type', 'book')->where('publish', true)->limit(4)->get();

        $audio = Speech::where('type', 'audio')->where('publish', true)->limit(4)->get();

        $youtube = Speech::where('type', 'youtube')->where('publish', true)->limit(4)->get();

        $videos = Speech::where('type', 'video')->where('publish', true)->limit(4)->get();

        return view('pages.home', compact('gallery', 'events', 'audio', 'books', 'youtube', 'speeaches', 'videos'));
    }



    public function gallery()
    {
        Paginator::useBootstrap();

        $gallery = Gallery::latest()->paginate(12);

        return view('pages.gallery', compact('gallery'));
    }



    public function contact()
    {

        return view('pages.contact');
    }

    public function calendar()
    {
        $calendar = Calendar::where('publish', true)->limit(3)->get();

        return view('pages.calendar', compact('calendar'));
    }


    public function projects()
    {
        Paginator::useBootstrap();

        return view('pages.project-list');
    }


    public function project_page(Request $request)
    {
        Paginator::useBootstrap();

        $data = Project::where('id', $request->id)->where('publish', true)->first();

        return view('pages.project-page', compact('data'));
    }


    public function about()
    {
        return view('pages.about');
    }


    public function events()
    {
        Paginator::useBootstrap();

        return view('pages.event-list');
    }


    public function event_page(Request $request)
    {
        Paginator::useBootstrap();

        $data = Event::where('id', $request->id)->where('publish', true)->first();

        return view('pages.event-page', compact('data'));
    }


    public function videos()
    {
        Paginator::useBootstrap();

        $videos = Speech::where('type', 'video')->where('publish', true)->paginate(12);

        return view('pages.videolist', compact('videos'));
    }

    public function youtube()
    {
        Paginator::useBootstrap();

        $youtube = Speech::where('type', 'youtube')->where('publish', true)->paginate(12);

        return view('pages.youtubelist', compact('youtube'));
    }

    public function books()
    {
        Paginator::useBootstrap();

        $books = Speech::where('type', 'book')->where('publish', true)->paginate(12);

        return view('pages.booklist', compact('books'));
    }

    public function audio()
    {
        Paginator::useBootstrap();

        $audio = Speech::where('type', 'audio')->where('publish', true)->paginate(12);

        return view('pages.audiolist', compact('audio'));
    }



    public function dailyContribution()
    {
        return view('pages.donation.daily-contribution');
    }

    public function dailyContributionPayment($id, $date)
    {
        if ($id == null && $date == null) {
            return redirect('/');
        }

        $user = Community::find($id);

        if ($user == null) {
            return redirect('/');
        }

        // Parse the date from the URL (this should be the next_reminder_date)
        $requestDate = Carbon::parse($date);
        $today = Carbon::now();

        // Get user's next reminder date and program date
        $nextReminderDate = Carbon::parse($user->next_reminder_date);
        $programDate = Carbon::parse($user->date);

        // Check if payment is already completed for this cycle
        if ($user->payment_completed) {
            return redirect('/')->with([
                'popup_type' => 'success',
                'popup_title' => 'Already Paid!',
                'popup_message' => 'Your payment has already been completed for this cycle. Thank you for your contribution!'
            ]);
        }

        // TIMING LOGIC:
        // 1. Early Payment: Current date is more than 3 days before next_reminder_date
        // 2. On Time: Current date is within 3 days of next_reminder_date (before or after)
        // 3. Late Payment: Current date is more than 3 days after next_reminder_date

        $daysUntilReminder = $today->diffInDays($nextReminderDate, false); // false = can be negative

        // Security check: Validate the URL date matches the user's next_reminder_date
        if (!$requestDate->equalTo($nextReminderDate)) {
            return redirect('/')->with([
                'popup_type' => 'error',
                'popup_title' => 'Invalid Link!',
                'popup_message' => 'This payment link is invalid or expired. Please use the link from your latest reminder email.'
            ]);
        }

        // Check if user missed the payment deadline (more than 3 days late)
        if ($daysUntilReminder < -3) {
            $daysPastReminder = abs($daysUntilReminder);
            return redirect('/')->with([
                'popup_type' => 'error',
                'popup_title' => 'Payment Deadline Missed!',
                'popup_message' => "You missed the payment deadline! Your reminder date was {$nextReminderDate->format('Y-m-d')} ({$daysPastReminder} days ago). Please wait for your next reminder email."
            ]);
        }

        $message = '';
        $messageType = 'info';

        if ($daysUntilReminder > 3) {
            // Early payment - more than 3 days before reminder date
            $message = "You are paying early! Your reminder date is {$nextReminderDate->format('Y-m-d')} ({$daysUntilReminder} days from now).";
            $messageType = 'warning';
        } else {
            // On time - within 3 days of reminder date
            if ($daysUntilReminder > 0) {
                $message = "Perfect timing! Your reminder date is {$nextReminderDate->format('Y-m-d')} (in {$daysUntilReminder} days).";
            } elseif ($daysUntilReminder < 0) {
                $daysPastReminder = abs($daysUntilReminder);
                $message = "You can still pay! Your reminder date was {$nextReminderDate->format('Y-m-d')} ({$daysPastReminder} days ago).";
            } else {
                $message = "Today is your reminder date! Perfect timing for payment.";
            }
            $messageType = 'success';
        }

        // Pass the message to the view
        return view('pages.donation.daily-contribution-payment', compact('id', 'date', 'message', 'messageType'));
    }
    public function dailyAlms()
    {
        return view('pages.donation.daily-alms');
    }

    public function donations()
    {
        return view('pages.donation.donation');
    }
}
