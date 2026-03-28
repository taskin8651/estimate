@extends('admin.layout')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Edit Brand</h2>

    <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium">Name</label>
            <input type="text" name="name" value="{{ $brand->name }}"
                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label class="block mb-1 font-medium">Current Logo</label>
            <img src="{{ $brand->logo_url }}" class="h-16 mt-2">
        </div>

        <div>
            <label class="block mb-1 font-medium">Change Logo</label>
            <input type="file" name="logo"
                class="w-full border rounded-lg px-3 py-2 bg-white">
        </div>

        <button class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
            Update Brand
        </button>
    </form>

</div>
@endsection