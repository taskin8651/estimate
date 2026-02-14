@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-semibold mb-6">Edit Client</h2>

    <form action="{{ route('admin.clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">

            <input type="text" name="name"
                   value="{{ $client->name }}"
                   class="border rounded px-3 py-2" required>

            <input type="email" name="email"
                   value="{{ $client->email }}"
                   class="border rounded px-3 py-2">

            <input type="text" name="phone"
                   value="{{ $client->phone }}"
                   class="border rounded px-3 py-2">

            <input type="text" name="city"
                   value="{{ $client->city }}"
                   class="border rounded px-3 py-2">

            <input type="text" name="state"
                   value="{{ $client->state }}"
                   class="border rounded px-3 py-2">

            <input type="text" name="country"
                   value="{{ $client->country }}"
                   class="border rounded px-3 py-2">

            <input type="text" name="zip"
                   value="{{ $client->zip }}"
                   class="border rounded px-3 py-2">

        </div>

        <textarea name="address"
                  class="w-full border rounded px-3 py-2 mt-4">{{ $client->address }}</textarea>

        <button class="mt-6 bg-blue-600 text-white px-6 py-2 rounded">
            Update Client
        </button>

    </form>

</div>

@endsection
