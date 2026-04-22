<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                @lang('crud.calendars.index_title')
            </h2>
            @can('create', App\Models\Calendar::class)
            <a href="{{ route('calendars.create') }}"
                class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition">
                <i class="icon ion-md-add text-base"></i> New Calendar
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-5">

            @php
            $typeLabels = [
            'sunrice' => ['label' => 'Sunrise & Sunset', 'color' => 'orange'],
            'uposatha' => ['label' => 'Uposatha Calendar', 'color' => 'blue'],
            'poya_day' => ['label' => 'Poya Day Calendar', 'color' => 'yellow'],
            ];
            $typeColors = [
            'orange' => 'bg-orange-100 text-orange-700',
            'blue' => 'bg-blue-100 text-blue-700',
            'yellow' => 'bg-yellow-100 text-yellow-700',
            ];
            @endphp

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-5 py-4">
                <form method="GET" class="flex flex-wrap gap-3 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Search</label>
                        <div class="relative">
                            <i class="icon ion-md-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="search" value="{{ $search ?? '' }}"
                                placeholder="Title..."
                                class="w-full pl-9 pr-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 outline-none">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                            <i class="icon ion-md-search"></i> Search
                        </button>
                        @if($search ?? '')
                        <a href="{{ route('calendars.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700 border border-gray-200 px-3 py-2 rounded-lg transition">
                            <i class="icon ion-md-close"></i> Clear
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <p class="text-sm text-gray-500">
                        <span class="font-semibold text-gray-800">{{ $calendars->total() }}</span> records
                        @if($calendars->total() != $calendars->count())
                        &mdash; showing {{ $calendars->firstItem() }}-{{ $calendars->lastItem() }}
                        @endif
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                <th class="px-5 py-3 text-left">Type</th>
                                <th class="px-5 py-3 text-left">Title</th>
                                <th class="px-5 py-3 text-left">PDF</th>
                                <th class="px-5 py-3 text-left">Publish</th>
                                <th class="px-5 py-3 text-center w-28">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($calendars as $calendar)
                            @php
                            $typeInfo = $typeLabels[$calendar->type] ?? ['label' => $calendar->type, 'color' => 'blue'];
                            $colorClass = $typeColors[$typeInfo['color']] ?? 'bg-gray-100 text-gray-600';
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center gap-1 text-xs {{ $colorClass }} px-2.5 py-1 rounded-full font-medium">
                                        <i class="icon ion-md-calendar"></i> {{ $typeInfo['label'] }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <p class="font-medium text-gray-800">{{ $calendar->title ?? '-' }}</p>
                                </td>
                                <td class="px-5 py-3.5">
                                    @if($calendar->pdf)
                                    <a href="{{ \Storage::url($calendar->pdf) }}" target="_blank" rel="noopener"
                                        class="inline-flex items-center gap-1 text-xs bg-red-100 text-red-700 px-2.5 py-1 rounded-full font-medium hover:bg-red-200 transition">
                                        <i class="icon ion-md-document"></i> PDF
                                    </a>
                                    @else
                                    <span class="text-gray-400 text-xs">No PDF</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5">
                                    @if($calendar->publish)
                                    <span class="inline-flex items-center gap-1 text-xs bg-green-100 text-green-700 px-2.5 py-1 rounded-full font-medium">
                                        <i class="icon ion-md-checkmark"></i> Published
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1 text-xs bg-gray-100 text-gray-500 px-2.5 py-1 rounded-full font-medium">
                                        <i class="icon ion-md-eye-off"></i> Draft
                                    </span>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <div class="inline-flex items-center gap-1">
                                        @can('update', $calendar)
                                        <a href="{{ route('calendars.edit', $calendar) }}" title="Edit"
                                            class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-gray-100 hover:bg-indigo-100 hover:text-indigo-600 text-gray-500 transition">
                                            <i class="icon ion-md-create text-sm"></i>
                                        </a>
                                        @endcan
                                        @can('view', $calendar)
                                        <a href="{{ route('calendars.show', $calendar) }}" title="View"
                                            class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-gray-100 hover:bg-blue-100 hover:text-blue-600 text-gray-500 transition">
                                            <i class="icon ion-md-eye text-sm"></i>
                                        </a>
                                        @endcan
                                        @can('delete', $calendar)
                                        <form action="{{ route('calendars.destroy', $calendar) }}" method="POST"
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
                                <td colspan="5" class="px-5 py-16 text-center">
                                    <div class="flex flex-col items-center text-gray-400">
                                        <i class="icon ion-md-calendar text-5xl mb-3"></i>
                                        <p class="font-medium">@lang('crud.common.no_items_found')</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($calendars->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $calendars->withQueryString()->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>