@extends('layouts.admin')

@section('content')
<div class="p-6">

    <div class="flex justify-between mb-6">
        <h2 class="text-2xl font-bold">Pricing Plans</h2>

        @if($plans->count() < 3)
        <a href="{{ route('admin.pricing.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
           + Add Plan
        </a>
        @endif
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid md:grid-cols-3 gap-6">
        @foreach($plans as $plan)
        <div class="bg-white shadow rounded-lg p-5 relative
            {{ $plan->type == 'popular' ? 'border-2 border-yellow-400 scale-105' : '' }}">

            @if($plan->type == 'popular')
            <span class="absolute top-2 right-2 bg-yellow-400 text-white text-xs px-2 py-1 rounded">
                Popular
            </span>
            @endif

            <h3 class="text-xl font-bold">{{ $plan->name }}</h3>

            <p class="text-2xl text-blue-600 mt-2">
                ₹{{ $plan->price }}
            </p>

            <p class="text-gray-500">{{ $plan->duration }}</p>

            <ul class="mt-4 space-y-2 text-sm">
                @foreach($plan->features ?? [] as $feature)
                    <li>✔ {{ $feature }}</li>
                @endforeach
            </ul>

            <div class="flex gap-2 mt-4">
                <a href="{{ route('admin.pricing.edit', $plan->id) }}"
                   class="bg-yellow-400 text-white px-3 py-1 rounded">
                   Edit
                </a>

                <form action="{{ route('admin.pricing.destroy', $plan->id) }}" method="POST">
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