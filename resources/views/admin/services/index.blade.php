@extends('admin.layout')

@section('content')
<div class="p-6">

    <div class="flex justify-between mb-6">
        <h2 class="text-2xl font-bold">Services</h2>
        <a href="{{ route('services.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
           + Add Service
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach($services as $service)
        <div class="bg-white shadow rounded-lg p-4">

            <img src="{{ $service->icon ? asset('storage/'.$service->icon) : '' }}"
                 class="h-16 w-16 object-contain">

            <h3 class="text-lg font-semibold mt-3">{{ $service->name }}</h3>

            <p class="text-gray-600 text-sm">{{ $service->description }}</p>

            <p class="text-blue-600 font-bold mt-2">
                ₹{{ $service->base_price }}
            </p>

            <div class="flex gap-2 mt-4">
                <a href="{{ route('services.edit', $service->id) }}"
                   class="bg-yellow-400 text-white px-3 py-1 rounded">
                   Edit
                </a>

                <form action="{{ route('services.destroy', $service->id) }}" method="POST">
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