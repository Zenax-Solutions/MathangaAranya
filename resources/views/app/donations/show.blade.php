<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.donations.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('donations.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.donations.inputs.type')
                        </h5>
                        <span>{{ $donation->type ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.donations.inputs.first_name')
                        </h5>
                        <span>{{ $donation->first_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.donations.inputs.last_name')
                        </h5>
                        <span>{{ $donation->last_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.donations.inputs.email')
                        </h5>
                        <span>{{ $donation->email ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            Country
                        </h5>
                        <span>{{ $donation->country ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            Phone Number
                        </h5>
                        <span>{{ $donation->phone_number ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.donations.inputs.address')
                        </h5>
                        <span>{{ $donation->address ?? '-' }}</span>
                    </div>
                  
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.donations.inputs.date')
                        </h5>
                        <span>{{ $donation->date->format('Y-m-d') ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.donations.inputs.description')
                        </h5>
                        <span>{{ $donation->description ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            Amount
                        </h5>
                        <span>{{ number_format($donation->amount) ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.donations.inputs.slip')
                        </h5>
                        @if($donation->slip)
                        <a
                            href="{{ \Storage::url($donation->slip) }}"
                            target="blank"
                            ><i class="mr-1 icon ion-md-download"></i
                            >&nbsp;Download</a
                        >
                        @else - @endif
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('donations.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Donation::class)
                    <a href="{{ route('donations.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
