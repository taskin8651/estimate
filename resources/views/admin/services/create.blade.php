@extends('admin.layout')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Add Service</h2>

    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <input type="text" name="name" placeholder="Service Name"
            class="w-full border px-3 py-2 rounded">

        <textarea name="description" placeholder="Description"
            class="w-full border px-3 py-2 rounded"></textarea>

        <input type="number" name="base_price" placeholder="Base Price"
            class="w-full border px-3 py-2 rounded">

        <input type="file" name="icon"
            class="w-full border px-3 py-2 rounded">

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Save
        </button>

    </form>

</div>
@endsection