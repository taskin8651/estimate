@extends('layouts.admin')

@section('content')
<div class="p-6">

    <div class="flex justify-between mb-6">
        <h2 class="text-2xl font-bold">Hero Section</h2>
        <a href="{{ route('admin.hero.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
           + Add Hero
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid md:grid-cols-2 gap-6">
        @foreach($heroes as $hero)
        <div class="bg-white shadow rounded-lg p-4">

            <img src="{{ $hero->image_url }}" class="w-full h-40 object-cover rounded">

            <h3 class="text-lg font-semibold mt-3">{{ $hero->title }}</h3>
            <p class="text-gray-600 text-sm">{{ $hero->subtitle }}</p>

            <div class="flex gap-2 mt-4">
                <a href="{{ route('admin.hero.edit', $hero->id) }}" 
                   class="bg-yellow-400 text-white px-3 py-1 rounded">
                   Edit
                </a>

                <form action="{{ route('admin.hero.destroy', $hero->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-3 py-1 rounded">
                        Delete
                    </button>
                </form>
            </div>

        </div>
        @endforeach
    </div>

</div>
@endsection