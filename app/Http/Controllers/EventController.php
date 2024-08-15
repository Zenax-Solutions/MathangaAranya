<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Event::class);

        $search = $request->get('search', '');

        $events = Event::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.events.index', compact('events', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Event::class);

        return view('app.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Event::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $event = Event::create($validated);

        return redirect()
            ->route('events.edit', $event)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Event $event): View
    {
        $this->authorize('view', $event);

        return view('app.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Event $event): View
    {
        $this->authorize('update', $event);

        return view('app.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        EventUpdateRequest $request,
        Event $event
    ): RedirectResponse {
        $this->authorize('update', $event);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::delete($event->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $event->update($validated);

        return redirect()
            ->route('events.edit', $event)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Event $event): RedirectResponse
    {
        $this->authorize('delete', $event);

        if ($event->image) {
            Storage::delete($event->image);
        }

        $event->delete();

        return redirect()
            ->route('events.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
