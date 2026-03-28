@extends('admin.layout')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Add Hero</h2>

    <form action="{{ route('hero.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <input type="text" name="title" placeholder="Title"
            class="w-full border px-3 py-2 rounded">

        <textarea name="subtitle" placeholder="Subtitle"
            class="w-full border px-3 py-2 rounded"></textarea>

        <input type="text" name="button_text" placeholder="Button Text"
            class="w-full border px-3 py-2 rounded">

        <input type="text" name="button_link" placeholder="Button Link"
            class="w-full border px-3 py-2 rounded">

        <input type="file" name="image"
            class="w-full border px-3 py-2 rounded">

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>

</div>
@endsection