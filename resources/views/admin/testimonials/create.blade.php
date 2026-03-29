@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Add Testimonial</h2>

    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <input type="text" name="name" placeholder="Client Name"
            class="w-full border px-3 py-2 rounded">

        <textarea name="message" placeholder="Message"
            class="w-full border px-3 py-2 rounded"></textarea>

        <input type="number" name="rating" min="1" max="5" placeholder="Rating (1-5)"
            class="w-full border px-3 py-2 rounded">

        <input type="file" name="image"
            class="w-full border px-3 py-2 rounded">

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Save
        </button>

    </form>

</div>
@endsection