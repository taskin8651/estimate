@extends('admin.layout')

@section('content')
<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Brands</h2>
        <a href="{{ route('brands.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            + Add Brand
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">#</th>
                    <th class="p-3">Logo</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr class="border-t">
                    <td class="p-3">{{ $loop->iteration }}</td>

                    <td class="p-3">
                        <img src="{{ $brand->logo_url }}" class="h-10 w-10 object-contain">
                    </td>

                    <td class="p-3">{{ $brand->name }}</td>

                    <td class="p-3 flex gap-2">
                        <a href="{{ route('brands.edit', $brand->id) }}" 
                           class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">
                            Edit
                        </a>

                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($brands->isEmpty())
                <tr>
                    <td colspan="4" class="text-center p-6 text-gray-500">
                        No brands found
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
@endsection