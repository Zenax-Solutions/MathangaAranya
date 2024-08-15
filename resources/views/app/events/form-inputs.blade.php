@php $editing = isset($event) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $event->image ? \Storage::url($event->image) : '' }}')"
        >
            <x-inputs.partials.label
                name="image"
                label="Image"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="image"
                    id="image"
                    @change="fileChosen"
                />
            </div>

            @error('image') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="type" label="News or Event Type">
            @php $selected = old('type', ($editing ? $event->type : '')) @endphp
            <option value="katina_puja" {{ $selected == 'katina_puja' ? 'selected' : '' }} >KATINA ROBE CEREMONY</option>
            <option value="kuti_puja" {{ $selected == 'kuti_puja' ? 'selected' : '' }} >KUTI POOJA</option>
            <option value="vesak_puja" {{ $selected == 'vesak_puja' ? 'selected' : '' }} >VESAK POYA CEREMON</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $event->title : ''))"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea id="summernote_1" name="description" label="Description" required
            >{{ old('description', ($editing ? $event->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="publish"
            label="Publish"
            :checked="old('publish', ($editing ? $event->publish : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
