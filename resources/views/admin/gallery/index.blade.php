@extends('layouts.admin')

@section('content')
<div class="p-6">

    <div class="flex justify-between mb-6">
        <h2 class="text-2xl font-bold">Gallery</h2>

        <a href="{{ route('admin.gallery.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
           + Add Image
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid md:grid-cols-3 gap-6">

        @foreach($galleries as $item)
        <div class="bg-white shadow rounded-lg overflow-hidden">

            <img src="{{ $item->getFirstMediaUrl('gallery') }}"
                 class="w-full h-48 object-cover">

            <div class="p-4">

                <h3 class="text-lg font-semibold">{{ $item->title }}</h3>

                <p class="text-sm mt-1">
                    @if($item->status)
                        <span class="text-green-600 font-medium">Active</span>
                    @else
                        <span class="text-red-500 font-medium">Inactive</span>
                    @endif
                </p>

                <div class="flex gap-2 mt-4">

                    <a href="{{ route('admin.gallery.edit', $item->id) }}"
                       class="bg-yellow-400 text-white px-3 py-1 rounded">
                       Edit
                    </a>

                    <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button onclick="return confirm('Delete?')"
                                class="bg-red-500 text-white px-3 py-1 rounded">
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        </div>
        @endforeach

    </div>

</div>
@endsection