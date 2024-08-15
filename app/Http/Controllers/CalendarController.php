<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CalendarStoreRequest;
use App\Http\Requests\CalendarUpdateRequest;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Calendar::class);

        $search = $request->get('search', '');

        $calendars = Calendar::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.calendars.index', compact('calendars', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Calendar::class);

        return view('app.calendars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CalendarStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Calendar::class);

        $validated = $request->validated();
        if ($request->hasFile('pdf')) {
            $validated['pdf'] = $request->file('pdf')->store('public');
        }

        $calendar = Calendar::create($validated);

        return redirect()
            ->route('calendars.edit', $calendar)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Calendar $calendar): View
    {
        $this->authorize('view', $calendar);

        return view('app.calendars.show', compact('calendar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Calendar $calendar): View
    {
        $this->authorize('update', $calendar);

        return view('app.calendars.edit', compact('calendar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CalendarUpdateRequest $request,
        Calendar $calendar
    ): RedirectResponse {
        $this->authorize('update', $calendar);

        $validated = $request->validated();
        if ($request->hasFile('pdf')) {
            if ($calendar->pdf) {
                Storage::delete($calendar->pdf);
            }

            $validated['pdf'] = $request->file('pdf')->store('public');
        }

        $calendar->update($validated);

        return redirect()
            ->route('calendars.edit', $calendar)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Calendar $calendar
    ): RedirectResponse {
        $this->authorize('delete', $calendar);

        if ($calendar->pdf) {
            Storage::delete($calendar->pdf);
        }

        $calendar->delete();

        return redirect()
            ->route('calendars.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
