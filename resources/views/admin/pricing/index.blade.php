@extends('admin.layout')

@section('content')
<div class="p-6">

    <div class="flex justify-between mb-6">
        <h2 class="text-2xl font-bold">Pricing Plans</h2>
        <a href="{{ route('pricing.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
           + Add Plan
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid md:grid-cols-3 gap-6">
        @foreach($plans as $plan)
        <div class="bg-white shadow rounded-lg p-5">

            <h3 class="text-xl font-bold">{{ $plan->name }}</h3>
            <p class="text-2xl text-blue-600 mt-2">
                ₹{{ $plan->price }}
            </p>
            <p class="text-gray-500">{{ $plan->duration }}</p>

            <ul class="mt-4 space-y-2 text-sm">
                @if($plan->features)
                    @foreach($plan->features as $feature)
                        <li>✔ {{ $feature }}</li>
                    @endforeach
                @endif
            </ul>

            <div class="flex gap-2 mt-4">
                <a href="{{ route('pricing.edit', $plan->id) }}"
                   class="bg-yellow-400 text-white px-3 py-1 rounded">
                   Edit
                </a>

                <form action="{{ route('pricing.destroy', $plan->id) }}" method="POST">
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