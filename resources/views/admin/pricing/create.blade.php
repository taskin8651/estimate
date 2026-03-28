@extends('admin.layout')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Add Pricing Plan</h2>

    <form action="{{ route('pricing.store') }}" method="POST" class="space-y-4">
        @csrf

        <input type="text" name="name" placeholder="Plan Name"
            class="w-full border px-3 py-2 rounded">

        <input type="number" name="price" placeholder="Price"
            class="w-full border px-3 py-2 rounded">

        <input type="text" name="duration" placeholder="Monthly / Yearly"
            class="w-full border px-3 py-2 rounded">

        <div id="features-wrapper">
            <label class="font-medium">Features</label>
            <input type="text" name="features[]" class="w-full border px-3 py-2 rounded mt-2">
        </div>

        <button type="button" onclick="addFeature()"
            class="bg-gray-200 px-3 py-1 rounded">
            + Add Feature
        </button>

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Save
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