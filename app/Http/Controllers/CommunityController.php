<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CommunityStoreRequest;
use App\Http\Requests\CommunityUpdateRequest;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Community::class);

        $search = $request->get('search', '');

        $communities = Community::search($search)
            ->orderByRaw("strftime('%Y', date) DESC, strftime('%m', date) DESC, strftime('%d', date) DESC")
            ->paginate(10)
            ->withQueryString();

        return view('app.communities.index', compact('communities', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Community::class);

        return view('app.communities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommunityStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Community::class);

        $validated = $request->validated();
        if ($request->hasFile('slip')) {
            $validated['slip'] = $request->file('slip')->store('public');
        }

        $community = Community::create($validated);

        return redirect()
            ->route('communities.edit', $community)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Community $community): View
    {
        $this->authorize('view', $community);

        return view('app.communities.show', compact('community'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Community $community): View
    {
        $this->authorize('update', $community);

        return view('app.communities.edit', compact('community'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommunityUpdateRequest $request, Community $community): RedirectResponse
    {

        $this->authorize('update', $community);

        $validated = $request->validated();

        if ($request->hasFile('slip')) {
            if ($community->slip) {
                Storage::delete($community->slip);
            }

            $validated['slip'] = $request->file('slip')->store('public');
        }

        $community->update($validated);

        return redirect()
            ->route('communities.edit', $community)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Community $community
    ): RedirectResponse {
        $this->authorize('delete', $community);

        if ($community->slip) {
            Storage::delete($community->slip);
        }

        $community->delete();

        return redirect()
            ->route('communities.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
