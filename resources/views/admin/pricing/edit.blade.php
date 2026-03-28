@extends('admin.layout')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Edit Plan</h2>

    <form action="{{ route('pricing.update', $plan->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $plan->name }}"
            class="w-full border px-3 py-2 rounded">

        <input type="number" name="price" value="{{ $plan->price }}"
            class="w-full border px-3 py-2 rounded">

        <input type="text" name="duration" value="{{ $plan->duration }}"
            class="w-full border px-3 py-2 rounded">

        <div id="features-wrapper">
            <label class="font-medium">Features</label>

            @if($plan->features)
                @foreach($plan->features as $feature)
                    <input type="text" name="features[]" value="{{ $feature }}"
                        class="w-full border px-3 py-2 rounded mt-2">
                @endforeach
            @endif
        </div>

        <button type="button" onclick="addFeature()"
            class="bg-gray-200 px-3 py-1 rounded">
            + Add Feature
        </button>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>

    </form>

</div>

<script>
function addFeature() {
    let wrapper = document.getElementById('features-wrapper');
    let input = document.createElement('input');
    input.type = 'text';
    input.name = 'features[]';
    input.className = 'w-full border px-3 py-2 rounded mt-2';
    wrapper.appendChild(input);
}
</script>
@endsection