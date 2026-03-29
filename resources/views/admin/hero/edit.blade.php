@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Edit Hero</h2>

    <form action="{{ route('admin.hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="title" value="{{ $hero->title }}"
            class="w-full border px-3 py-2 rounded">

        <textarea name="subtitle"
            class="w-full border px-3 py-2 rounded">{{ $hero->subtitle }}</textarea>

        <input type="text" name="button_text" value="{{ $hero->button_text }}"
            class="w-full border px-3 py-2 rounded">

        <input type="text" name="button_link" value="{{ $hero->button_link }}"
            class="w-full border px-3 py-2 rounded">

        <img src="{{ $hero->image_url }}" class="h-32 rounded">

        <input type="file" name="image"
            class="w-full border px-3 py-2 rounded">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>

</div>
@endsection