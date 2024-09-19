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

        return view('pages.home', compact('gallery','events', 'audio', 'books', 'youtube', 'speeaches', 'videos'));
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

    public function dailyContributionPayment($id,$date)
    {
        if($id == null && $date == null)
        {
            return redirect('/');
        }

        $user = Community::find($id);


        if($user->date <= Carbon::now())
        {
             $user->update([
                'date' => $date,
            ]);

            return redirect('/');
        }

        return view('pages.donation.daily-contribution-payment',compact('id','date'));
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
