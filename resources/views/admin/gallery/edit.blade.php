@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-xl mx-auto bg-white shadow rounded-lg">

    <h2 class="text-xl font-bold mb-4">Edit Gallery</h2>

    <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-medium">Title</label>
            <input type="text" name="title"
                   value="{{ $gallery->title }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Current Image</label>
            <img src="{{ $gallery->getFirstMediaUrl('gallery') }}"
                 class="w-40 h-40 object-cover rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Change Image</label>
            <input type="file" name="image"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Status</label>
            <select name="status"
                    class="w-full border rounded px-3 py-2">
                <option value="1" {{ $gallery->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$gallery->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="flex gap-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>

            <a href="{{ route('admin.gallery.index') }}"
               class="bg-gray-400 text-white px-4 py-2 rounded">
               Back
            </a>
        </div>

    </form>

</div>
@endsection