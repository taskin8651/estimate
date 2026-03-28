@extends('admin.layout')

@section('content')
<div class="p-6">

    <div class="flex justify-between mb-6">
        <h2 class="text-2xl font-bold">Testimonials</h2>
        <a href="{{ route('testimonials.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
           + Add Testimonial
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid md:grid-cols-3 gap-6">
        @foreach($testimonials as $t)
        <div class="bg-white shadow rounded-lg p-5">

            <div class="flex items-center gap-3">
                <img src="{{ $t->image_url }}" class="h-12 w-12 rounded-full object-cover">
                <div>
                    <h4 class="font-semibold">{{ $t->name }}</h4>
                    <div class="text-yellow-400">
                        @for($i=1; $i<=5; $i++)
                            {{ $i <= $t->rating ? '★' : '☆' }}
                        @endfor
                    </div>
                </div>
            </div>

            <p class="text-gray-600 mt-3 text-sm">
                {{ $t->message }}
            </p>

            <div class="flex gap-2 mt-4">
                <a href="{{ route('testimonials.edit', $t->id) }}"
                   class="bg-yellow-400 text-white px-3 py-1 rounded">
                   Edit
                </a>

                <form action="{{ route('testimonials.destroy', $t->id) }}" method="POST">
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