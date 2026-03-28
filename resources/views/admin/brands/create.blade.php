@extends('admin.layout')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Add Brand</h2>

    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block mb-1 font-medium">Name</label>
            <input type="text" name="name"
                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label class="block mb-1 font-medium">Logo</label>
            <input type="file" name="logo"
                class="w-full border rounded-lg px-3 py-2 bg-white" required>
        </div>

        <button class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
            Save Brand
        </button>
    </form>

</div>
@endsection