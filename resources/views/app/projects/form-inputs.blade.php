@php $editing = isset($project) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $project->feature_image ? \Storage::url($project->feature_image) : '' }}')"
        >
            <x-inputs.partials.label
                name="feature_image"
                label="Feature Image"
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
                    name="feature_image"
                    id="feature_image"
                    @change="fileChosen"
                />
            </div>

            @error('feature_image') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $project->title : ''))"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
           id="summernote_1"
            name="short_description"
            label="Short Description"
            required
            >{{ old('short_description', ($editing ? $project->short_description
            : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea id="summernote_2" name="description" label="Description"
            >{{ old('description', ($editing ? $project->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($project->date)->format('Y-m-d\TH:i:s') : '')) }}"
        ></x-inputs.datetime>
    </x-inputs.group>

    {{-- <x-inputs.group class="w-full">
        <x-inputs.number
            name="quantity"
            label="Quantity"
            :value="old('quantity', ($editing ? $project->quantity : ''))"
            placeholder="Quantity"
        ></x-inputs.number>
    </x-inputs.group> --}}

    {{-- <x-inputs.group class="w-full">
        <x-inputs.number
            name="price"
            label="Price"
            :value="old('price', ($editing ? $project->price : ''))"
            step="0.01"
            placeholder="Price"
        ></x-inputs.number>
    </x-inputs.group> --}}

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="publish"
            label="Publish"
            :checked="old('publish', ($editing ? $project->publish : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    {{-- <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $project->gallery ? \Storage::url($project->gallery) : '' }}')"
        >
            <x-inputs.partials.label
                name="gallery"
                label="Gallery"
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
                    name="gallery"
                    id="gallery"
                    @change="fileChosen"
                />
            </div>

            @error('gallery') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group> --}}
</div>
