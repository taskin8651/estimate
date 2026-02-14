@extends('layouts.admin')

@section('content')

<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Clients</h2>

        <a href="{{ route('admin.clients.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + Add Client
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-3">Name</th>
                <th class="border p-3">Email</th>
                <th class="border p-3">Phone</th>
                <th class="border p-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
                <tr>
                    <td class="border p-3">{{ $client->name }}</td>
                    <td class="border p-3">{{ $client->email }}</td>
                    <td class="border p-3">{{ $client->phone }}</td>
                    <td class="border p-3 text-center space-x-2">

                        <a href="{{ route('admin.clients.edit', $client->id) }}"
                           class="text-blue-600">Edit</a>

                        <form action="{{ route('admin.clients.destroy', $client->id) }}"
                              method="POST"
                              class="inline"
                              onsubmit="return confirm('Delete client?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600">Delete</button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center p-4 text-gray-500">
                        No clients found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $clients->links() }}
    </div>

</div>

@endsection
