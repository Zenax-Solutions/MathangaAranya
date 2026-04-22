@php $editing = isset($alm) @endphp

<div class="flex flex-wrap">

    <x-inputs.group class="w-full md:w-1/2">
        <x-inputs.select name="honorifics" :label="__('crud.alms.inputs.honorifics')">
            @php $sel = old('honorifics', $editing ? $alm->honorifics : '') @endphp
            <option value="">Select</option>
            <option value="Mr" {{ $sel == 'Mr'   ? 'selected' : '' }}>Mr</option>
            <option value="Mrs" {{ $sel == 'Mrs'  ? 'selected' : '' }}>Mrs</option>
            <option value="Miss" {{ $sel == 'Miss' ? 'selected' : '' }}>Miss</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full md:w-1/2">
        <x-inputs.text name="first_name" :label="__('crud.alms.inputs.first_name')"
            :value="old('first_name', $editing ? $alm->first_name : '')"
            placeholder="First Name" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full md:w-1/2">
        <x-inputs.text name="last_name" :label="__('crud.alms.inputs.last_name')"
            :value="old('last_name', $editing ? $alm->last_name : '')"
            placeholder="Last Name" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full md:w-1/2">
        <x-inputs.email name="email" :label="__('crud.alms.inputs.email')"
            :value="old('email', $editing ? $alm->email : '')"
            placeholder="Email" required></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full md:w-1/2">
        <x-inputs.text name="phone_number" :label="__('crud.alms.inputs.phone_number')"
            :value="old('phone_number', $editing ? $alm->phone_number : '')"
            placeholder="+94766101085" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full md:w-1/2">
        <x-inputs.text name="whatsapp_number" :label="__('crud.alms.inputs.whatsapp_number')"
            :value="old('whatsapp_number', $editing ? $alm->whatsapp_number : '')"
            placeholder="+94766101085"></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full md:w-1/2">
        <x-inputs.text name="country" :label="__('crud.alms.inputs.country')"
            :value="old('country', $editing ? $alm->country : '')"
            placeholder="Sri Lanka" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full md:w-1/2">
        <x-inputs.textarea name="address" :label="__('crud.alms.inputs.address')" required>{{ old('address', $editing ? $alm->address : '') }}</x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="w-full md:w-1/2">
        <x-inputs.date name="date" :label="__('crud.alms.inputs.date')"
            value="{{ old('date', $editing ? optional($alm->date)->format('Y-m-d') : '') }}"
            required></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full md:w-1/2">
        <x-inputs.select name="type" :label="__('crud.alms.inputs.type')">
            @php $sel = old('type', $editing ? $alm->type : '') @endphp
            <option value="monthly" {{ $sel == 'monthly' ? 'selected' : '' }}>Every Month</option>
            <option value="yearly" {{ $sel == 'yearly'  ? 'selected' : '' }}>Every Year</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full md:w-1/2">
        <x-inputs.select name="meal_type" :label="__('crud.alms.inputs.meal_type')">
            @php $sel = old('meal_type', $editing ? $alm->meal_type : '') @endphp
            <option value="breakfast" {{ $sel == 'breakfast' ? 'selected' : '' }}>Breakfast (6:00 am) — හීල් දානය</option>
            <option value="lunch" {{ $sel == 'lunch'     ? 'selected' : '' }}>Lunch (10:00 am) — සාංඝික දානය</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="description" :label="__('crud.alms.inputs.description')">{{ old('description', $editing ? $alm->description : '') }}</x-inputs.textarea>
    </x-inputs.group>

    {{-- Admin adjustment section (edit only) --}}
    @if($editing)
    <div class="w-full bg-yellow-50 border-2 border-yellow-200 rounded-lg p-6 mt-6">
        <h3 class="text-lg font-semibold text-yellow-800 mb-4">🔧 Admin Manual Adjustments</h3>
        <p class="text-sm text-yellow-700 mb-4">Manually override reminder dates to correct any scheduler issues.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-inputs.group class="w-full">
                <x-inputs.date name="next_reminder_date" :label="__('crud.alms.inputs.next_reminder_date')"
                    value="{{ old('next_reminder_date', optional($alm->next_reminder_date)->format('Y-m-d')) }}">
                </x-inputs.date>
            </x-inputs.group>
            <x-inputs.group class="w-full">
                <x-inputs.date name="last_reminder_sent" :label="__('crud.alms.inputs.last_reminder_sent')"
                    value="{{ old('last_reminder_sent', optional($alm->last_reminder_sent)->format('Y-m-d')) }}">
                </x-inputs.date>
            </x-inputs.group>
        </div>
    </div>
    @endif

</div>