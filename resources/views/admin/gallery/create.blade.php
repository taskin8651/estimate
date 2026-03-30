@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-xl mx-auto bg-white shadow rounded-lg">

    <h2 class="text-xl font-bold mb-4">Add Gallery</h2>

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium">Title</label>
            <input type="text" name="title"
                   class="w-full border rounded px-3 py-2">

            @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Image</label>
            <input type="file" name="image"
                   class="w-full border rounded px-3 py-2">

            @error('image')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Status</label>
            <select name="status"
                    class="w-full border rounded px-3 py-2">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <div class="flex gap-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Save
            </button>

            <a href="{{ route('admin.gallery.index') }}"
               class="bg-gray-400 text-white px-4 py-2 rounded">
               Back
            </a>
        </div>

    </form>

</div>
@endsection