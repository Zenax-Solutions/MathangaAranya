<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                @lang('crud.donations.index_title')
            </h2>
            @can('create', App\Models\Donation::class)
            <a href="{{ route('donations.create') }}"
                class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition">
                <i class="icon ion-md-add text-base"></i> New Donation
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
                    <div class="flex gap-2">
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                            <i class="icon ion-md-search"></i> Search
                        </button>
                        @if($search ?? '')
                        <a href="{{ route('donations.index') }}"
                            class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700 border border-gray-200 px-3 py-2 rounded-lg transition">
                            <i class="icon ion-md-close"></i> Clear
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- ── TABLE CARD ── --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <p class="text-sm text-gray-500">
                        <span class="font-semibold text-gray-800">{{ $donations->total() }}</span> records
                        @if($donations->total() != $donations->count())
                        · showing {{ $donations->firstItem() }}–{{ $donations->lastItem() }}
                        @endif
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                <th class="px-5 py-3 text-left">Donor</th>
                                <th class="px-5 py-3 text-left">Contact</th>
                                <th class="px-5 py-3 text-left">Country</th>
                                <th class="px-5 py-3 text-left">Purpose</th>
                                <th class="px-5 py-3 text-left">Date</th>
                                <th class="px-5 py-3 text-left">Amount</th>
                                <th class="px-5 py-3 text-left">Slip</th>
                                <th class="px-5 py-3 text-center w-28">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($donations as $donation)
                            @php
                            $avatarColors = ['bg-emerald-100 text-emerald-700','bg-teal-100 text-teal-700','bg-cyan-100 text-cyan-700','bg-green-100 text-green-700','bg-indigo-100 text-indigo-700','bg-purple-100 text-purple-700'];
                            $avatarColor = $avatarColors[crc32($donation->first_name ?? '') % count($avatarColors)];
                            $typeLabels = [
                            'electricity_bill' => ['label' => 'Electricity Bill', 'icon' => 'ion-md-flash', 'class' => 'bg-yellow-100 text-yellow-800'],
                            'water_bill' => ['label' => 'Water Bill', 'icon' => 'ion-md-water', 'class' => 'bg-blue-100 text-blue-800'],
                            'development' => ['label' => 'Temple Dev.', 'icon' => 'ion-md-construct','class' => 'bg-purple-100 text-purple-800'],
                            'katina_pinkam' => ['label' => 'Katina Pinkam', 'icon' => 'ion-md-star', 'class' => 'bg-rose-100 text-rose-800'],
                            ];
                            $typeInfo = $typeLabels[$donation->type] ?? ['label' => ucfirst($donation->type ?? '—'), 'icon' => 'ion-md-heart', 'class' => 'bg-gray-100 text-gray-600'];
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full {{ $avatarColor }} flex items-center justify-center font-bold text-sm shrink-0">
                                            {{ strtoupper(substr($donation->first_name ?? '?', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800 leading-tight">
                                                {{ trim(($donation->first_name ?? '') . ' ' . ($donation->last_name ?? '')) ?: '—' }}
                                            </p>
                                            @if($donation->address)
                                            <p class="text-xs text-gray-400 mt-0.5 truncate max-w-[160px]">{{ $donation->address }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5">
                                    <a href="mailto:{{ $donation->email }}" class="text-indigo-600 hover:underline text-sm block leading-tight">{{ $donation->email ?? '—' }}</a>
                                    @if($donation->phone_number)
                                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $donation->phone_number) }}" target="_blank"
                                        class="inline-flex items-center gap-1 text-xs text-green-600 hover:underline mt-0.5">
                                        <i class="icon ion-logo-whatsapp"></i> {{ $donation->phone_number }}
                                    </a>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="text-sm text-gray-600">{{ $donation->country ? ucwords(strtolower($donation->country)) : '—' }}</span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center gap-1 text-xs {{ $typeInfo['class'] }} px-2.5 py-1 rounded-full font-medium">
                                        <i class="icon {{ $typeInfo['icon'] }}"></i> {{ $typeInfo['label'] }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="text-sm text-gray-600">{{ $donation->date ? $donation->date->format('M d, Y') : '—' }}</span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="text-sm font-semibold text-gray-800">Rs. {{ number_format($donation->amount ?? 0) }}</span>
                                </td>
                                <td class="px-5 py-3.5">
                                    @if($donation->slip)
                                    <a href="{{ \Storage::url($donation->slip) }}" target="_blank"
                                        class="inline-flex items-center gap-1 text-xs bg-blue-50 text-blue-600 hover:bg-blue-100 px-2.5 py-1 rounded-full font-medium transition">
                                        <i class="icon ion-md-download"></i> Download
                                    </a>
                                    @else
                                    <span class="text-gray-300 text-xs">No slip</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <div class="inline-flex items-center gap-1">
                                        @can('update', $donation)
                                        <a href="{{ route('donations.edit', $donation) }}" title="Edit"
                                            class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-gray-100 hover:bg-indigo-100 hover:text-indigo-600 text-gray-500 transition">
                                            <i class="icon ion-md-create text-sm"></i>
                                        </a>
                                        @endcan
                                        @can('view', $donation)
                                        <a href="{{ route('donations.show', $donation) }}" title="View"
                                            class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-gray-100 hover:bg-blue-100 hover:text-blue-600 text-gray-500 transition">
                                            <i class="icon ion-md-eye text-sm"></i>
                                        </a>
                                        @endcan
                                        @can('delete', $donation)
                                        <form action="{{ route('donations.destroy', $donation) }}" method="POST"
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
                                <td colspan="8" class="px-5 py-16 text-center">
                                    <div class="flex flex-col items-center text-gray-400">
                                        <i class="icon ion-md-heart text-5xl mb-3"></i>
                                        <p class="font-medium">@lang('crud.common.no_items_found')</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($donations->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $donations->withQueryString()->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>