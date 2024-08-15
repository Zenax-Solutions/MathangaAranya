<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Project::class);

        $search = $request->get('search', '');

        $projects = Project::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.projects.index', compact('projects', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Project::class);

        return view('app.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Project::class);

        $validated = $request->validated();
        if ($request->hasFile('feature_image')) {
            $validated['feature_image'] = $request
                ->file('feature_image')
                ->store('public');
        }

        // if ($request->hasFile('gallery')) {
        //     $validated['gallery'] = $request->file('gallery')->store('public');
        // }

        // $validated['gallery'] = json_decode($validated['gallery'], true);

        $project = Project::create($validated);

        return redirect()
            ->route('projects.edit', $project)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Project $project): View
    {
        $this->authorize('view', $project);

        return view('app.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Project $project): View
    {
        $this->authorize('update', $project);

        return view('app.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ProjectUpdateRequest $request,
        Project $project
    ): RedirectResponse {
        $this->authorize('update', $project);

        $validated = $request->validated();
        if ($request->hasFile('feature_image')) {
            if ($project->feature_image) {
                Storage::delete($project->feature_image);
            }

            $validated['feature_image'] = $request
                ->file('feature_image')
                ->store('public');
        }

        if ($request->hasFile('gallery')) {
            if ($project->gallery) {
                Storage::delete($project->gallery);
            }

            $validated['gallery'] = $request->file('gallery')->store('public');
        }

        $validated['gallery'] = json_decode($validated['gallery'], true);

        $project->update($validated);

        return redirect()
            ->route('projects.edit', $project)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Project $project
    ): RedirectResponse {
        $this->authorize('delete', $project);

        if ($project->feature_image) {
            Storage::delete($project->feature_image);
        }

        if ($project->gallery) {
            Storage::delete($project->gallery);
        }

        $project->delete();

        return redirect()
            ->route('projects.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
