<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.alms.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('alms.index') }}" class="mr-4"><i class="mr-1 icon ion-md-arrow-back"></i></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <h5 class="font-medium text-gray-700">Title</h5>
                            <p>{{ $alm->honorifics ?? '-' }}</p>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-700">Full Name</h5>
                            <p>{{ $alm->honorifics }} {{ $alm->first_name }} {{ $alm->last_name }}</p>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-700">Email</h5>
                            <p><a href="mailto:{{ $alm->email }}" style="color:blue">{{ $alm->email }}</a></p>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-700">Phone Number</h5>
                            <p>{{ $alm->phone_number ?? '-' }}</p>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-700">WhatsApp</h5>
                            <p>
                                @if($alm->whatsapp_number)
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $alm->whatsapp_number) }}" target="_blank" style="color:rgb(78,221,42)">
                                    {{ $alm->whatsapp_number }}
                                </a>
                                @else - @endif
                            </p>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-700">Country</h5>
                            <p>{{ $alm->country ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <h5 class="font-medium text-gray-700">Address</h5>
                            <p>{{ $alm->address ?? '-' }}</p>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-700">Dana Date</h5>
                            <p>{{ $alm->date ? $alm->date->format('Y-m-d') : '-' }}</p>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-700">Frequency</h5>
                            <p>{{ ucfirst($alm->type) }}</p>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-700">Meal Type</h5>
                            <p>
                                @if($alm->meal_type === 'breakfast')
                                <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded">Breakfast (6:00 am) — හීල් දානය</span>
                                @else
                                <span class="px-2 py-1 text-xs font-semibold bg-orange-100 text-orange-800 rounded">Lunch (10:00 am) — සාංඝික දානය</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-700">Next Reminder Date</h5>
                            <p>{{ $alm->next_reminder_date ? $alm->next_reminder_date->format('Y-m-d') : '-' }}</p>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-700">Last Reminder Sent</h5>
                            <p>{{ $alm->last_reminder_sent ? $alm->last_reminder_sent->format('Y-m-d') : 'Not yet sent' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <h5 class="font-medium text-gray-700">Description</h5>
                            <p>{{ $alm->description ?? '-' }}</p>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-700">Registered At</h5>
                            <p>{{ $alm->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 px-4">
                    <a href="{{ route('alms.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>
                    @can('update', $alm)
                    <a href="{{ route('alms.edit', $alm) }}" class="button button-primary float-right">
                        <i class="mr-1 icon ion-md-create"></i>
                        @lang('crud.common.edit')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>