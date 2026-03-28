@extends('admin.layout')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Edit Service</h2>

    <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $service->name }}"
            class="w-full border px-3 py-2 rounded">

        <textarea name="description"
            class="w-full border px-3 py-2 rounded">{{ $service->description }}</textarea>

        <input type="number" name="base_price" value="{{ $service->base_price }}"
            class="w-full border px-3 py-2 rounded">

        @if($service->icon)
            <img src="{{ asset('storage/'.$service->icon) }}" class="h-16">
        @endif

        <input type="file" name="icon"
            class="w-full border px-3 py-2 rounded">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>

    </form>

</div>
@endsection