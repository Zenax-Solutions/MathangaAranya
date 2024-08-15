<?php

namespace App\Http\Controllers;

use App\Models\Speech;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SpeechStoreRequest;
use App\Http\Requests\SpeechUpdateRequest;

class SpeechController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Speech::class);

        $search = $request->get('search', '');

        $speeches = Speech::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.speeches.index', compact('speeches', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Speech::class);

        return view('app.speeches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpeechStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Speech::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('data')) {
            $validated['data'] = $request->file('data')->store('public');
        }

        $speech = Speech::create($validated);

        return redirect()
            ->route('speeches.edit', $speech)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Speech $speech): View
    {
        $this->authorize('view', $speech);

        return view('app.speeches.show', compact('speech'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Speech $speech): View
    {
        $this->authorize('update', $speech);

        return view('app.speeches.edit', compact('speech'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SpeechUpdateRequest $request,
        Speech $speech
    ): RedirectResponse {
        $this->authorize('update', $speech);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($speech->image) {
                Storage::delete($speech->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('data')) {
            if ($speech->data) {
                Storage::delete($speech->data);
            }

            $validated['data'] = $request->file('data')->store('public');
        }

        $speech->update($validated);

        return redirect()
            ->route('speeches.edit', $speech)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Speech $speech): RedirectResponse
    {
        $this->authorize('delete', $speech);

        if ($speech->image) {
            Storage::delete($speech->image);
        }

        if ($speech->data) {
            Storage::delete($speech->data);
        }

        $speech->delete();

        return redirect()
            ->route('speeches.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
