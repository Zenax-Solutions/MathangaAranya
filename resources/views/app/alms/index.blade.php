<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                @lang('crud.alms.index_title')
            </h2>
            @can('create', App\Models\Alms::class)
            <a href="{{ route('alms.create') }}"
                class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition">
                <i class="icon ion-md-add text-base"></i> New Registration
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8 space-y-5">

            {{-- ── FILTER BAR ── --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-5 py-4">
                <form method="GET" class="flex flex-wrap gap-3 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Search</label>
                        <div class="relative">
                            <i class="icon ion-md-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="search" value="{{ $search ?? '' }}"
                                placeholder="Name, email, phone…"
                                class="w-full pl-9 pr-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Frequency</label>
                        <select name="frequency" class="text-sm border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-300 outline-none">
                            <option value="">All</option>
                            <option value="monthly" {{ ($frequency ?? '') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            <option value="yearly" {{ ($frequency ?? '') == 'yearly'  ? 'selected' : '' }}>Yearly</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Meal</label>
                        <select name="meal_type" class="text-sm border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-300 outline-none">
                            <option value="">All Meals</option>
                            <option value="breakfast" {{ ($mealType ?? '') == 'breakfast' ? 'selected' : '' }}>Breakfast (6am)</option>
                            <option value="lunch" {{ ($mealType ?? '') == 'lunch'     ? 'selected' : '' }}>Lunch (10am)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Sort</label>
                        <select name="sort" class="text-sm border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-300 outline-none">
                            <option value="reminder_asc" {{ ($sort ?? '') == 'reminder_asc'  ? 'selected' : '' }}>Reminder ↑ (default)</option>
                            <option value="reminder_desc" {{ ($sort ?? '') == 'reminder_desc' ? 'selected' : '' }}>Reminder ↓</option>
                            <option value="name_asc" {{ ($sort ?? '') == 'name_asc'      ? 'selected' : '' }}>Name A–Z</option>
                            <option value="created_desc" {{ ($sort ?? '') == 'created_desc'  ? 'selected' : '' }}>Newest First</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                            <i class="icon ion-md-search"></i> Filter
                        </button>
                        @if($search || $frequency || $mealType || ($sort && $sort !== 'reminder_asc'))
                        <a href="{{ route('alms.index') }}"
                            class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700 border border-gray-200 px-3 py-2 rounded-lg transition">
                            <i class="icon ion-md-close"></i> Clear
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- ── TABLE CARD ── --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- Table header strip --}}
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <p class="text-sm text-gray-500">
                        <span class="font-semibold text-gray-800">{{ $alms->total() }}</span> records
                        @if($alms->total() != $alms->count())
                        · showing {{ $alms->firstItem() }}–{{ $alms->lastItem() }}
                        @endif
                    </p>
                    <div class="flex items-center gap-2 text-xs text-gray-400">
                        <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 rounded-sm bg-red-100 inline-block"></span> Overdue</span>
                        <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 rounded-sm bg-yellow-50 inline-block"></span> Due soon</span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                <th class="px-5 py-3 text-left">Person</th>
                                <th class="px-5 py-3 text-left">Contact</th>
                                <th class="px-5 py-3 text-left">Dana Date</th>
                                <th class="px-5 py-3 text-left">Next Reminder</th>
                                <th class="px-5 py-3 text-left">Frequency</th>
                                <th class="px-5 py-3 text-left">Meal</th>
                                <th class="px-5 py-3 text-center w-28">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($alms as $alm)
                            @php
                            $daysUntil = $alm->next_reminder_date
                            ? \Carbon\Carbon::today()->diffInDays($alm->next_reminder_date, false)
                            : null;
                            $rowBg = '';
                            if ($daysUntil !== null) {
                            if ($daysUntil < 0) $rowBg='bg-red-50 hover:bg-red-100' ;
                                elseif ($daysUntil <=3) $rowBg='bg-yellow-50 hover:bg-yellow-100' ;
                                else $rowBg='hover:bg-gray-50' ;
                                } else {
                                $rowBg='hover:bg-gray-50' ;
                                }
                                $avatarColors=['bg-amber-100 text-amber-700','bg-orange-100 text-orange-700','bg-rose-100 text-rose-700','bg-pink-100 text-pink-700','bg-yellow-100 text-yellow-700','bg-red-100 text-red-700'];
                                $avatarColor=$avatarColors[crc32($alm->first_name ?? '') % count($avatarColors)];
                                @endphp
                                <tr class="transition-colors {{ $rowBg }}">

                                    {{-- Person --}}
                                    <td class="px-5 py-3.5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full {{ $avatarColor }} flex items-center justify-center font-bold text-sm shrink-0">
                                                {{ strtoupper(substr($alm->first_name ?? '?', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800 leading-tight">
                                                    {{ trim(($alm->honorifics ? $alm->honorifics . ' ' : '') . $alm->first_name . ' ' . $alm->last_name) }}
                                                </p>
                                                <p class="text-xs text-gray-400 mt-0.5">
                                                    Registered {{ $alm->created_at->format('M d, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Contact --}}
                                    <td class="px-5 py-3.5">
                                        <a href="mailto:{{ $alm->email }}" class="text-indigo-600 hover:underline text-sm block leading-tight">
                                            {{ $alm->email }}
                                        </a>
                                        @if($alm->whatsapp_number)
                                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $alm->whatsapp_number) }}" target="_blank"
                                            class="inline-flex items-center gap-1 text-xs text-green-600 hover:underline mt-0.5">
                                            <i class="icon ion-logo-whatsapp"></i>
                                            {{ $alm->whatsapp_number }}
                                        </a>
                                        @elseif($alm->phone_number)
                                        <span class="text-xs text-gray-400 mt-0.5 block">{{ $alm->phone_number }}</span>
                                        @endif
                                    </td>

                                    {{-- Dana Date --}}
                                    <td class="px-5 py-3.5">
                                        <span class="text-sm text-gray-600">
                                            {{ $alm->date ? $alm->date->format('M d, Y') : '—' }}
                                        </span>
                                    </td>

                                    {{-- Next Reminder --}}
                                    <td class="px-5 py-3.5">
                                        @if($alm->next_reminder_date)
                                        <p class="text-sm font-medium text-gray-700">{{ $alm->next_reminder_date->format('M d, Y') }}</p>
                                        @if($daysUntil !== null)
                                        @if($daysUntil < 0)
                                            <span class="inline-flex items-center gap-1 text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full font-semibold mt-1">
                                            <i class="icon ion-md-alert"></i> {{ abs((int)$daysUntil) }}d overdue
                                            </span>
                                            @elseif($daysUntil == 0)
                                            <span class="inline-flex items-center gap-1 text-xs bg-orange-100 text-orange-700 px-2 py-0.5 rounded-full font-semibold mt-1">
                                                <i class="icon ion-md-time"></i> Today
                                            </span>
                                            @elseif($daysUntil <= 3)
                                                <span class="inline-flex items-center gap-1 text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full font-semibold mt-1">
                                                <i class="icon ion-md-notifications"></i> in {{ (int)$daysUntil }}d
                                                </span>
                                                @else
                                                <span class="inline-flex items-center gap-1 text-xs text-gray-400 mt-1">
                                                    in {{ (int)$daysUntil }} days
                                                </span>
                                                @endif
                                                @endif
                                                @else
                                                <span class="text-gray-400">—</span>
                                                @endif
                                    </td>

                                    {{-- Frequency --}}
                                    <td class="px-5 py-3.5">
                                        @if($alm->type === 'monthly')
                                        <span class="inline-flex items-center gap-1 text-xs bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full font-medium">
                                            <i class="icon ion-md-sync"></i> Monthly
                                        </span>
                                        @elseif($alm->type === 'yearly')
                                        <span class="inline-flex items-center gap-1 text-xs bg-purple-100 text-purple-700 px-2.5 py-1 rounded-full font-medium">
                                            <i class="icon ion-md-calendar"></i> Yearly
                                        </span>
                                        @else
                                        <span class="text-gray-400 text-xs">{{ ucfirst($alm->type ?? '—') }}</span>
                                        @endif
                                    </td>

                                    {{-- Meal --}}
                                    <td class="px-5 py-3.5">
                                        @if($alm->meal_type === 'breakfast')
                                        <span class="inline-flex items-center gap-1 text-xs bg-sky-100 text-sky-700 px-2.5 py-1 rounded-full font-medium">
                                            <i class="icon ion-md-sunny"></i> Breakfast 6am
                                        </span>
                                        @elseif($alm->meal_type === 'lunch')
                                        <span class="inline-flex items-center gap-1 text-xs bg-orange-100 text-orange-700 px-2.5 py-1 rounded-full font-medium">
                                            <i class="icon ion-md-restaurant"></i> Lunch 10am
                                        </span>
                                        @else
                                        <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-5 py-3.5 text-center">
                                        <div class="inline-flex items-center gap-1">
                                            @can('update', $alm)
                                            <a href="{{ route('alms.edit', $alm) }}"
                                                title="Edit"
                                                class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-gray-100 hover:bg-indigo-100 hover:text-indigo-600 text-gray-500 transition">
                                                <i class="icon ion-md-create text-sm"></i>
                                            </a>
                                            @endcan
                                            @can('view', $alm)
                                            <a href="{{ route('alms.show', $alm) }}"
                                                title="View"
                                                class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-gray-100 hover:bg-blue-100 hover:text-blue-600 text-gray-500 transition">
                                                <i class="icon ion-md-eye text-sm"></i>
                                            </a>
                                            @endcan
                                            @can('delete', $alm)
                                            <form action="{{ route('alms.destroy', $alm) }}" method="POST"
                                                onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                @csrf @method('DELETE')
                                                <button type="submit" title="Delete"
                                                    class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-gray-100 hover:bg-red-100 hover:text-red-600 text-gray-500 transition">
                                                    <i class="icon ion-md-trash text-sm"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-5 py-16 text-center">
                                        <div class="flex flex-col items-center text-gray-400">
                                            <i class="icon ion-md-restaurant text-5xl mb-3"></i>
                                            <p class="font-medium">No alms registrations found.</p>
                                            @if($search || $frequency || $mealType)
                                            <p class="text-sm mt-1">Try adjusting your search or filters.</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>

                @if($alms->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $alms->withQueryString()->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>