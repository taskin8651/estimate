@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-semibold mb-6">Add Client</h2>

    <form action="{{ route('admin.clients.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-2 gap-4">

            <input type="text" name="name" placeholder="Client Name"
                   class="border rounded px-3 py-2" required>

            <input type="email" name="email" placeholder="Email"
                   class="border rounded px-3 py-2">

            <input type="text" name="phone" placeholder="Phone"
                   class="border rounded px-3 py-2">

            <input type="text" name="city" placeholder="City"
                   class="border rounded px-3 py-2">

            <input type="text" name="state" placeholder="State"
                   class="border rounded px-3 py-2">

            <input type="text" name="country" placeholder="Country"
                   class="border rounded px-3 py-2">

            <input type="text" name="zip" placeholder="Zip"
                   class="border rounded px-3 py-2">

        </div>

        <textarea name="address" placeholder="Address"
                  class="w-full border rounded px-3 py-2 mt-4"></textarea>

        <button class="mt-6 bg-green-600 text-white px-6 py-2 rounded">
            Save Client
        </button>

    </form>

</div>

@endsection
