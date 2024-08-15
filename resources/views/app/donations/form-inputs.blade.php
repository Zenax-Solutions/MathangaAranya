@php $editing = isset($donation) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="type" label="Donation Type">
            @php $selected = old('type', ($editing ? $donation->type : '')) @endphp
            <option value="electricity_bill" {{ $selected == 'electricity_bill' ? 'selected' : '' }} >ELECTRICITY BILL</option>
            <option value="water_bill" {{ $selected == 'water_bill' ? 'selected' : '' }} >WATER BILL</option>
            <option value="development" {{ $selected == 'development' ? 'selected' : '' }} >TEMPLE DEVOLOPMET</option>
            <option value="development" {{ $selected == 'katina_pinkam' ? 'selected' : '' }} >KATINA PINKAM</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="first_name"
            label="First Name"
            :value="old('first_name', ($editing ? $donation->first_name : ''))"
            placeholder="First Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="last_name"
            label="Last Name"
            :value="old('last_name', ($editing ? $donation->last_name : ''))"
            placeholder="Last Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $donation->email : ''))"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="address"
            label="Address"
            :value="old('address', ($editing ? $donation->address : ''))"
            placeholder="Address"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($donation->date)->format('Y-m-d') : '')) }}"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="description" label="Description" required
            >{{ old('description', ($editing ? $donation->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.partials.label
            name="slip"
            label="Slip"
        ></x-inputs.partials.label
        ><br />

        <input type="file" name="slip" id="slip" class="form-control-file" />

        @if($editing && $donation->slip)
        <div class="mt-2">
            <a href="{{ \Storage::url($donation->slip) }}" target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('slip') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>
</div>
