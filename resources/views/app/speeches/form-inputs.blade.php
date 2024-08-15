@php $editing = isset($speech) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $speech->image ? \Storage::url($speech->image) : '' }}')"
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
        <x-inputs.select name="type" label="Type">
            @php $selected = old('type', ($editing ? $speech->type : '')) @endphp
            <option value="book" {{ $selected == 'book' ? 'selected' : '' }} >BOOK</option>
            <option value="video" {{ $selected == 'video' ? 'selected' : '' }} >VIDEO</option>
            <option value="audio" {{ $selected == 'audio' ? 'selected' : '' }} >AUDIO</option>
            <option value="youtube" {{ $selected == 'youtube' ? 'selected' : '' }} >YOUTUBE</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $speech->title : ''))"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="description" label="Link ( Youtube Only )"
            >{{ old('description', ($editing ? $speech->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.partials.label
            name="data"
            label="Attach Media File "
        ></x-inputs.partials.label
        ><br />

        <input type="file" name="data" id="data" class="form-control-file" />

        @if($editing && $speech->data)
        <div class="mt-2">
            <a href="{{ \Storage::url($speech->data) }}" target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('data') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="publish"
            label="Publish"
            :checked="old('publish', ($editing ? $speech->publish : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
