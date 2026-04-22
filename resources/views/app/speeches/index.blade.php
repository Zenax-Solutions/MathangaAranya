<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                @lang('crud.speeches.index_title')
            </h2>
            @can('create', App\Models\Speech::class)
            <a href="{{ route('speeches.create') }}"
                class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition">
                <i class="icon ion-md-add text-base"></i> New Speech
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-5">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-5 py-4">
                <form method="GET" class="flex flex-wrap gap-3 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Search</label>
                        <div class="relative">
                            <i class="icon ion-md-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="search" value="{{ $search ?? '' }}"
                                placeholder="Title, type..."
                                class="w-full pl-9 pr-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 outline-none">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                            <i class="icon ion-md-search"></i> Search
                        </button>
                        @if($search ?? '')
                        <a href="{{ route('speeches.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700 border border-gray-200 px-3 py-2 rounded-lg transition">
                            <i class="icon ion-md-close"></i> Clear
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <p class="text-sm text-gray-500">
                        <span class="font-semibold text-gray-800">{{ $speeches->total() }}</span> records
                        @if($speeches->total() != $speeches->count())
                        &mdash; showing {{ $speeches->firstItem() }}-{{ $speeches->lastItem() }}
                        @endif
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                <th class="px-5 py-3 text-left">Image</th>
                                <th class="px-5 py-3 text-left">Type</th>
                                <th class="px-5 py-3 text-left">Title</th>
                                <th class="px-5 py-3 text-left">YouTube Link</th>
                                <th class="px-5 py-3 text-left">Data</th>
                                <th class="px-5 py-3 text-left">Publish</th>
                                <th class="px-5 py-3 text-center w-28">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($speeches as $speech)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-5 py-3">
                                    <x-partials.thumbnail src="{{ $speech->image ? \Storage::url($speech->image) : '' }}" />
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center gap-1 text-xs bg-rose-100 text-rose-700 px-2.5 py-1 rounded-full font-medium">
                                        <i class="icon ion-md-mic"></i> {{ $speech->type ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <p class="font-medium text-gray-800">{{ $speech->title ?? '-' }}</p>
                                </td>
                                <td class="px-5 py-3.5">
                                    @if($speech->description)
                                    <a href="{{ $speech->description }}" target="_blank" rel="noopener"
                                        class="inline-flex items-center gap-1 text-xs bg-red-100 text-red-700 px-2.5 py-1 rounded-full font-medium hover:bg-red-200 transition">
                                        <i class="icon ion-logo-youtube"></i> YouTube
                                    </a>
                                    @else
                                    <span class="text-gray-400 text-xs">?</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5">
                                    @if($speech->data)
                                    <a href="{{ \Storage::url($speech->data) }}" target="_blank" rel="noopener"
                                        class="inline-flex items-center gap-1 text-xs bg-sky-100 text-sky-700 px-2.5 py-1 rounded-full font-medium hover:bg-sky-200 transition">
                                        <i class="icon ion-md-download"></i> Download
                                    </a>
                                    @else
                                    <span class="text-gray-400 text-xs">No file</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5">
                                    @if($speech->publish)
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
                                        @can('update', $speech)
                                        <a href="{{ route('speeches.edit', $speech) }}" title="Edit"
                                            class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-gray-100 hover:bg-indigo-100 hover:text-indigo-600 text-gray-500 transition">
                                            <i class="icon ion-md-create text-sm"></i>
                                        </a>
                                        @endcan
                                        @can('view', $speech)
                                        <a href="{{ route('speeches.show', $speech) }}" title="View"
                                            class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-gray-100 hover:bg-blue-100 hover:text-blue-600 text-gray-500 transition">
                                            <i class="icon ion-md-eye text-sm"></i>
                                        </a>
                                        @endcan
                                        @can('delete', $speech)
                                        <form action="{{ route('speeches.destroy', $speech) }}" method="POST"
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
                                        <i class="icon ion-md-mic text-5xl mb-3"></i>
                                        <p class="font-medium">@lang('crud.common.no_items_found')</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($speeches->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $speeches->withQueryString()->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>