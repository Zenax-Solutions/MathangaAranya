<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SpeechController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route Pages

Route::get('/', [PageController::class, 'index']);
Route::get('/gallery', [PageController::class, 'gallery']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('/calendar', [PageController::class, 'calendar']);
Route::get('/projects', [PageController::class, 'projects']);
Route::get('/projects/{id}', [PageController::class, 'project_page']);
Route::get('/events', [PageController::class, 'events']);
Route::get('/events/{id}', [PageController::class, 'event_page']);
Route::get('/about-us', [PageController::class, 'about']);

Route::get('/thank-you', function () {


    if (session('message') == null) {
        return redirect('/');
    }


    return view('pages.thank-you');
});

// Donation Pages

Route::get('/donate', [PageController::class, 'donations']);
Route::get('/donate/daily-contribution', [PageController::class, 'dailyContribution']);
Route::get('/donate/daily-contribution/payment/{id}/{date}', [PageController::class, 'dailyContributionPayment']);
Route::get('/donate/daily-alms', [PageController::class, 'dailyAlms']);



//Media Pages

Route::get('/dhammdeshana/videos', [PageController::class, 'videos']);
Route::get('/dhammdeshana/youtube', [PageController::class, 'youtube']);
Route::get('/dhammdeshana/books', [PageController::class, 'books']);
Route::get('/dhammdeshana/audio', [PageController::class, 'audio']);


//Cache clear & storagelink

Route::get('/cache', function () {


    Artisan::call('optimize:clear');
    //Artisan::call('storage:link');

    return "cache clear and storage:link done";

});


//Admin Pages
Route::middleware(['auth:sanctum', 'verified'])
    ->get('/admin/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/admin')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('calendars', CalendarController::class);
        Route::resource('communities', CommunityController::class);
        Route::resource('donations', DonationController::class);
        Route::resource('events', EventController::class);
        Route::resource('galleries', GalleryController::class);
        Route::resource('projects', ProjectController::class);
        Route::resource('speeches', SpeechController::class);
    });
