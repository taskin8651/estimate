@extends('layouts.admin')

@section('content')

<div class="max-w-xl mx-auto bg-white shadow rounded-lg p-6">

    <h2 class="text-xl font-semibold text-gray-800 mb-6">
        Edit Tax
    </h2>

    <form action="{{ route('admin.tax.update', $tax->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Tax Name --}}
        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Tax Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $tax->name) }}"
                oninput="this.value = this.value.toUpperCase()"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500"
            >

            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        {{-- Rate --}}
        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Rate (%)
            </label>

            <input
                type="number"
                step="0.01"
                name="rate"
                value="{{ old('rate', $tax->rate) }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500"
            >

            @error('rate')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        {{-- Type --}}
        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Tax Type
            </label>

            <select name="type"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">

                <option value="">Select Type</option>
                <option value="GST" {{ $tax->type == 'GST' ? 'selected' : '' }}>GST (India)</option>
                <option value="VAT" {{ $tax->type == 'VAT' ? 'selected' : '' }}>VAT (UAE)</option>

            </select>
        </div>


        {{-- Country --}}
        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Country
            </label>

            <select name="country"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">

                <option value="">Select Country</option>
                <option value="India" {{ $tax->country == 'India' ? 'selected' : '' }}>India</option>
                <option value="UAE" {{ $tax->country == 'UAE' ? 'selected' : '' }}>UAE</option>

            </select>
        </div>


        {{-- Default Tax --}}
        <div class="mb-6 flex items-center gap-2">
            <input type="checkbox"
                   name="is_default"
                   {{ $tax->is_default ? 'checked' : '' }}
                   class="rounded border-gray-300">

            <label class="text-sm text-gray-700">
                Set as Default Tax
            </label>
        </div>


        {{-- Buttons --}}
        <div class="flex items-center gap-3">

            <button
                type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Update
            </button>

            <a href="{{ route('admin.tax.index') }}"
               class="text-gray-600 hover:text-gray-800 text-sm">
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection