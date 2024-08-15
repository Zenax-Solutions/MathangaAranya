@php $editing = isset($community) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="first_name"
            label="First Name"
            :value="old('first_name', ($editing ? $community->first_name : ''))"
            placeholder="First Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="last_name"
            label="Last Name"
            :value="old('last_name', ($editing ? $community->last_name : ''))"
            placeholder="Last Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $community->email : ''))"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="address" label="Address" required
            >{{ old('address', ($editing ? $community->address : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($community->date)->format('Y-m-d') : '')) }}"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="type" label="Every month or Every year">
            @php $selected = old('type', ($editing ? $community->type : '')) @endphp
            <option value="monthly" {{ $selected == 'monthly' ? 'selected' : '' }} >MONTHLY</option>
            <option value="yearly" {{ $selected == 'yearly' ? 'selected' : '' }} >YEARLY</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="description" label="Description" required
            >{{ old('description', ($editing ? $community->description : ''))
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

        @if($editing && $community->slip)
        <div class="mt-2">
            <a href="{{ \Storage::url($community->slip) }}" target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('slip') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>
</div>
