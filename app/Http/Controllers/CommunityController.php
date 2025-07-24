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
        $paymentStatus = $request->get('payment_status', '');
        $frequency = $request->get('frequency', '');
        $sort = $request->get('sort', 'reminder_asc');

        $query = Community::query();

        // Search functionality
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        // Payment status filter
        if ($paymentStatus === 'completed') {
            $query->where('payment_completed', true);
        } elseif ($paymentStatus === 'pending') {
            $query->where('payment_completed', false)
                ->where(function ($q) {
                    $q->whereNull('next_reminder_date')
                        ->orWhere('next_reminder_date', '>=', now());
                });
        } elseif ($paymentStatus === 'overdue') {
            $query->where('payment_completed', false)
                ->where('next_reminder_date', '<', now());
        }

        // Frequency filter
        if ($frequency) {
            $query->where('type', $frequency);
        }

        // Sorting
        switch ($sort) {
            case 'reminder_asc':
                // Priority sort: overdue first, then due soon, then future dates
                $query->orderByRaw("
                    CASE 
                        WHEN payment_completed = 1 THEN 3
                        WHEN next_reminder_date IS NULL THEN 4
                        WHEN next_reminder_date < ? THEN 1
                        WHEN next_reminder_date <= ? THEN 2
                        ELSE 3
                    END, 
                    next_reminder_date ASC
                ", [now()->toDateString(), now()->addDays(3)->toDateString()]);
                break;
            case 'reminder_desc':
                $query->orderBy('next_reminder_date', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('first_name', 'asc')->orderBy('last_name', 'asc');
                break;
            case 'created_desc':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('next_reminder_date', 'asc');
        }

        $communities = $query->paginate(15)->withQueryString();

        return view('app.communities.index', compact('communities', 'search', 'paymentStatus', 'frequency', 'sort'));
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

        // Track manual adjustments for admin logging
        $manualAdjustments = [];
        $originalValues = $community->only(['next_reminder_date', 'payment_completed', 'amount', 'payment_date']);

        if ($request->hasFile('slip')) {
            if ($community->slip) {
                Storage::delete($community->slip);
            }

            $validated['slip'] = $request->file('slip')->store('public');
        }

        // Check for manual adjustments
        if ($request->filled('next_reminder_date') && $request->next_reminder_date != $originalValues['next_reminder_date']) {
            $manualAdjustments[] = "Next reminder date changed from {$originalValues['next_reminder_date']} to {$request->next_reminder_date}";
        }

        if ($request->filled('payment_completed') && (bool)$request->payment_completed != $originalValues['payment_completed']) {
            $status = $request->payment_completed ? 'Completed' : 'Pending';
            $oldStatus = $originalValues['payment_completed'] ? 'Completed' : 'Pending';
            $manualAdjustments[] = "Payment status changed from {$oldStatus} to {$status}";
        }

        if ($request->filled('amount') && $request->amount != $originalValues['amount']) {
            $manualAdjustments[] = "Amount changed from {$originalValues['amount']} to {$request->amount}";
        }

        if ($request->filled('payment_date') && $request->payment_date != $originalValues['payment_date']) {
            $manualAdjustments[] = "Payment date changed from {$originalValues['payment_date']} to {$request->payment_date}";
        }

        // Add admin adjustment log to reminder_notes if changes were made
        if (!empty($manualAdjustments)) {
            $timestamp = now()->format('Y-m-d H:i:s');
            $adminLog = "[ADMIN ADJUSTMENT - {$timestamp}]\n" . implode("\n", $manualAdjustments) . "\n\n";

            $existingNotes = $validated['reminder_notes'] ?? '';
            $validated['reminder_notes'] = $adminLog . $existingNotes;
        }

        $community->update($validated);

        $message = __('crud.common.saved');
        if (!empty($manualAdjustments)) {
            $message .= ' Manual adjustments have been logged.';
        }

        return redirect()
            ->route('communities.edit', $community)
            ->withSuccess($message);
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
