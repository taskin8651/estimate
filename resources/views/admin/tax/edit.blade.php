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
                value="{{ $tax->name }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            >
        </div>


        {{-- Tax Rate --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Rate (%)
            </label>

            <input
                type="number"
                step="0.01"
                name="rate"
                value="{{ $tax->rate }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            >
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