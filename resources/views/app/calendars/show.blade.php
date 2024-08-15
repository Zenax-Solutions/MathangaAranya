<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.calendars.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('calendars.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.calendars.inputs.type')
                        </h5>
                        <span>

                            @if ($calendar->type == 'sunrice')
                            SUNRISE & SUNSET CALENDAR
                            @elseif ($calendar->type == 'uposatha')
                            UPOSATHA CALENDAR
                            @elseif ($calendar->type == 'poya_day')
                            POYA DAY CALENDAR
                            @endif

                        </span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.calendars.inputs.title')
                        </h5>
                        <span>{{ $calendar->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.calendars.inputs.description')
                        </h5>
                        <span>{{ $calendar->description ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.calendars.inputs.pdf')
                        </h5>
                        @if($calendar->pdf)
                        <a
                            href="{{ \Storage::url($calendar->pdf) }}"
                            target="blank"
                            ><i class="mr-1 icon ion-md-download"></i
                            >&nbsp;Download</a
                        >
                        @else - @endif
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.calendars.inputs.publish')
                        </h5>
                        <span>{{ $calendar->publish ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('calendars.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Calendar::class)
                    <a href="{{ route('calendars.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
