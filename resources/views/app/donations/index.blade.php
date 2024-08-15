<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.donations.index_title')
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
                                    <x-inputs.text name="search" value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}" autocomplete="off"></x-inputs.text>

                                    <div class="ml-1">
                                        <button type="submit" class="button button-primary">
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Donation::class)
                                <a href="{{ route('donations.create') }}" class="button button-primary">
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
                                    Donation Purpose
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.donations.inputs.first_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.donations.inputs.last_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.donations.inputs.email')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Country
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Phone Number
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.donations.inputs.address')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.donations.inputs.date')
                                </th>
                                {{-- <th class="px-4 py-3 text-left">
                                    @lang('crud.donations.inputs.description')
                                </th> --}}
                                <th class="px-4 py-3 text-left">
                                    Amount
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.donations.inputs.slip')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($donations as $donation)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-left">

                                        @if ($donation->type == 'electricity_bill')
                                            ELECTRICITY BILL
                                        @elseif ($donation->type == 'water_bill')
                                            WATER BILL
                                        @elseif ($donation->type == 'development')
                                            TEMPLE DEVOLOPMET
                                        @elseif ($donation->type == 'katina_pinkam')
                                            KATINA PINKAM
                                        @endif

                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $donation->first_name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $donation->last_name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        <a href="mailto:{{ $donation->email }}"
                                            style="color: blue">{{ $donation->email ?? '-' }}</a>
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $donation->country ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        <a href="https://wa.me/{{ $donation->phone_number }}" target="_blank"
                                            style="color: rgb(78, 221, 42)">{{ $donation->phone_number ?? '-' }}</a>
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $donation->address ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $donation->date->format('Y-m-d') ?? '-' }}
                                    </td>
                                    {{-- <td class="px-4 py-3 text-left">
                                    {{ $donation->description ?? '-' }}
                                </td> --}}
                                    <td class="px-4 py-3 text-left">
                                        {{ number_format($donation->amount) ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        @if ($donation->slip)
                                            <a href="{{ \Storage::url($donation->slip) }}" target="blank"><i
                                                    class="mr-1 icon ion-md-download"></i>&nbsp;Download</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions"
                                            class="
                                            relative
                                            inline-flex
                                            align-middle
                                        ">
                                            @can('update', $donation)
                                                <a href="{{ route('donations.edit', $donation) }}" class="mr-1">
                                                    <button type="button" class="button">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $donation)
                                                <a href="{{ route('donations.show', $donation) }}" class="mr-1">
                                                    <button type="button" class="button">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $donation)
                                                <form action="{{ route('donations.destroy', $donation) }}" method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="button">
                                                        <i
                                                            class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "></i>
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
                                        {!! $donations->render() !!}
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
