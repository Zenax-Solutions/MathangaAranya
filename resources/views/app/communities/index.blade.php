<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.communities.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Community::class)
                            <a
                                href="{{ route('communities.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.communities.inputs.first_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.communities.inputs.last_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.communities.inputs.email')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Country
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Phone Number
                                </th>
                               
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.communities.inputs.date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.communities.inputs.type')
                                </th>
                                {{-- <th class="px-4 py-3 text-left">
                                    @lang('crud.communities.inputs.description')
                                </th> --}}
                                <th class="px-4 py-3 text-left">
                                    Amount
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.communities.inputs.slip')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($communities as $community)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $community->first_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $community->last_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <a href="mailto:{{$community->email}}" style="color: blue">{{ $community->email ?? '-' }}</a>
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $community->country ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <a href="https://wa.me/{{$community->phone_number}}" target="_blank" style="color: rgb(78, 221, 42)">{{ $community->phone_number ?? '-' }}</a>
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $community->date->format('Y-m-d') ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $community->type ?? '-' }}
                                </td>
                                {{-- <td class="px-4 py-3 text-left">
                                    {{ $community->description ?? '-' }}
                                </td> --}}
                                <td class="px-4 py-3 text-left">
                                    {{ number_format($community->amount) ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    @if($community->slip)
                                    <a
                                        href="{{ \Storage::url($community->slip) }}"
                                        target="blank"
                                        ><i
                                            class="mr-1 icon ion-md-download"
                                        ></i
                                        >&nbsp;Download</a
                                    >
                                    @else - @endif
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $community)
                                        <a
                                            href="{{ route('communities.edit', $community) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $community)
                                        <a
                                            href="{{ route('communities.show', $community) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $community)
                                        <form
                                            action="{{ route('communities.destroy', $community) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="9">
                                    <div class="mt-10 px-4">
                                        {!! $communities->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
