@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto bg-white p-6 rounded shadow">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Estimates</h2>

        <a href="{{ route('admin.estimates.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + Create Estimate
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-3 text-left">Estimate #</th>
                    <th class="border p-3 text-left">Client</th>
                    <th class="border p-3 text-left">Issue Date</th>
                    <th class="border p-3 text-left">Expiry Date</th>
                    <th class="border p-3 text-right">Total</th>
                    <th class="border p-3 text-center">Status</th>
                    <th class="border p-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($estimates as $estimate)
                    <tr class="hover:bg-gray-50">

                        <td class="border p-3 font-medium">
                            {{ $estimate->estimate_number }}
                        </td>

                        <td class="border p-3">
                            {{ $estimate->client->name ?? '-' }}
                        </td>

                        <td class="border p-3">
                            {{ $estimate->issue_date }}
                        </td>

                        <td class="border p-3">
                            {{ $estimate->expiry_date ?? '-' }}
                        </td>

                        <td class="border p-3 text-right font-semibold">
                            ₹ {{ number_format($estimate->total, 2) }}
                        </td>

                        <td class="border p-3 text-center">
                            @if($estimate->status == 'draft')
                                <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded text-xs">Draft</span>
                            @elseif($estimate->status == 'sent')
                                <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded text-xs">Sent</span>
                            @elseif($estimate->status == 'accepted')
                                <span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs">Accepted</span>
                            @elseif($estimate->status == 'rejected')
                                <span class="bg-red-200 text-red-800 px-2 py-1 rounded text-xs">Rejected</span>
                            @endif
                        </td>

                        <td class="border p-3 text-center space-x-2">

                            <a href="{{ route('admin.estimates.show', $estimate->id) }}"
                               class="text-blue-600 hover:underline">
                                View
                            </a>

                            <form action="{{ route('admin.estimates.destroy', $estimate->id) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Delete this estimate?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">
                                    Delete
                                </button>
                            </form>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center p-4 text-gray-500">
                            No estimates found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="mt-6">
        {{ $estimates->links() }}
    </div>

</div>

@endsection
