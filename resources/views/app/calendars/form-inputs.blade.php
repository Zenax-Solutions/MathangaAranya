@php $editing = isset($calendar) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select  name="type" label="Type">
            @php $selected = old('type', ($editing ? $calendar->type : '')) @endphp
            <option value="poya_day" {{ $selected == 'poya_day' ? 'selected' : '' }} >POYA DAY CALENDAR</option>
            <option value="uposatha" {{ $selected == 'uposatha' ? 'selected' : '' }} >UPOSATHA CALENDAR </option>
            <option value="sunrice" {{ $selected == 'sunrice' ? 'selected' : '' }} >SUNRISE & SUNSET CALENDAR</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $calendar->title : ''))"
            placeholder="Title"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="description" label="Description"
            >{{ old('description', ($editing ? $calendar->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.partials.label
            name="pdf"
            label="Pdf Attach"
        ></x-inputs.partials.label
        ><br />

        <input type="file" name="pdf" id="pdf" class="form-control-file" />

        @if($editing && $calendar->pdf)
        <div class="mt-2">
            <a href="{{ \Storage::url($calendar->pdf) }}" target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('pdf') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="publish"
            label="Publish"
            :checked="old('publish', ($editing ? $calendar->publish : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
