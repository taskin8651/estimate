@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Edit Testimonial</h2>

    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $testimonial->name }}"
            class="w-full border px-3 py-2 rounded">

        <textarea name="message"
            class="w-full border px-3 py-2 rounded">{{ $testimonial->message }}</textarea>

        <input type="number" name="rating" value="{{ $testimonial->rating }}"
            class="w-full border px-3 py-2 rounded">

        <img src="{{ $testimonial->image_url }}" class="h-16 rounded">

        <input type="file" name="image"
            class="w-full border px-3 py-2 rounded">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>

    </form>

</div>
@endsection