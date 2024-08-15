<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\GalleryStoreRequest;
use App\Http\Requests\GalleryUpdateRequest;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Gallery::class);

        $search = $request->get('search', '');

        $galleries = Gallery::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.galleries.index', compact('galleries', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Gallery::class);

        return view('app.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Gallery::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $gallery = Gallery::create($validated);

        return redirect()
            ->route('galleries.edit', $gallery)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Gallery $gallery): View
    {
        $this->authorize('view', $gallery);

        return view('app.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Gallery $gallery): View
    {
        $this->authorize('update', $gallery);

        return view('app.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        GalleryUpdateRequest $request,
        Gallery $gallery
    ): RedirectResponse {
        $this->authorize('update', $gallery);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::delete($gallery->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $gallery->update($validated);

        return redirect()
            ->route('galleries.edit', $gallery)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Gallery $gallery
    ): RedirectResponse {
        $this->authorize('delete', $gallery);

        if ($gallery->image) {
            Storage::delete($gallery->image);
        }

        $gallery->delete();

        return redirect()
            ->route('galleries.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
