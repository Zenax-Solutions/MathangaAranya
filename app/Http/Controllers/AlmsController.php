<?php

namespace App\Http\Controllers;

use App\Models\Alms;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AlmsController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('view-any', Alms::class);

        $search    = $request->get('search', '');
        $frequency = $request->get('frequency', '');
        $mealType  = $request->get('meal_type', '');
        $sort      = $request->get('sort', 'reminder_asc');

        $query = Alms::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name',  'like', "%{$search}%")
                    ->orWhere('email',      'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        if ($frequency) {
            $query->where('type', $frequency);
        }

        if ($mealType) {
            $query->where('meal_type', $mealType);
        }

        switch ($sort) {
            case 'reminder_asc':
                $query->orderByRaw("
                    CASE
                        WHEN next_reminder_date IS NULL THEN 2
                        WHEN next_reminder_date < ? THEN 0
                        WHEN next_reminder_date <= ? THEN 1
                        ELSE 2
                    END, next_reminder_date ASC
                ", [now()->toDateString(), now()->addDays(3)->toDateString()]);
                break;
            case 'reminder_desc':
                $query->orderBy('next_reminder_date', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('first_name', 'asc')->orderBy('last_name', 'asc');
                break;
            case 'created_desc':
            default:
                $query->orderBy('created_at', 'desc');
        }

        $alms = $query->paginate(15)->withQueryString();

        return view('app.alms.index', compact('alms', 'search', 'frequency', 'mealType', 'sort'));
    }

    public function create(): View
    {
        $this->authorize('create', Alms::class);

        return view('app.alms.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Alms::class);

        $validated = $request->validate([
            'honorifics'      => 'nullable|in:Mr,Mrs,Miss',
            'first_name'      => 'required|string|max:100',
            'last_name'       => 'required|string|max:100',
            'email'           => 'required|email',
            'phone_number'    => 'required|string',
            'whatsapp_number' => 'nullable|string',
            'country'         => 'required|string',
            'address'         => 'required|string',
            'date'            => 'required|date',
            'type'            => 'required|in:monthly,yearly',
            'meal_type'       => 'required|in:breakfast,lunch',
            'description'     => 'nullable|string',
        ]);

        $alm = Alms::create($validated);

        return redirect()
            ->route('alms.edit', $alm)
            ->withSuccess(__('crud.common.created'));
    }

    public function show(Alms $alm): View
    {
        $this->authorize('view', $alm);

        return view('app.alms.show', compact('alm'));
    }

    public function edit(Alms $alm): View
    {
        $this->authorize('update', $alm);

        return view('app.alms.edit', compact('alm'));
    }

    public function update(Request $request, Alms $alm): RedirectResponse
    {
        $this->authorize('update', $alm);

        $validated = $request->validate([
            'honorifics'         => 'nullable|in:Mr,Mrs,Miss',
            'first_name'         => 'required|string|max:100',
            'last_name'          => 'required|string|max:100',
            'email'              => 'required|email',
            'phone_number'       => 'required|string',
            'whatsapp_number'    => 'nullable|string',
            'country'            => 'required|string',
            'address'            => 'required|string',
            'date'               => 'required|date',
            'next_reminder_date' => 'nullable|date',
            'last_reminder_sent' => 'nullable|date',
            'type'               => 'required|in:monthly,yearly',
            'meal_type'          => 'required|in:breakfast,lunch',
            'description'        => 'nullable|string',
        ]);

        $alm->update($validated);

        return redirect()
            ->route('alms.edit', $alm)
            ->withSuccess(__('crud.common.saved'));
    }

    public function destroy(Alms $alm): RedirectResponse
    {
        $this->authorize('delete', $alm);

        $alm->delete();

        return redirect()
            ->route('alms.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
