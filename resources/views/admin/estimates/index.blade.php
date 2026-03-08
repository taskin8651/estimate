@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded shadow">

    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
        <h2 class="text-xl sm:text-2xl font-semibold">Estimates</h2>

        <a href="{{ route('admin.estimates.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm text-center">
            + Create Estimate
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- ================= DESKTOP TABLE ================= --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-3 text-left">Estimate #</th>
                    <th class="border p-3 text-left">Client</th>
                    <th class="border p-3 text-left">Issue Date</th>
                    <th class="border p-3 text-left">Expiry</th>
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

                        <td class="border p-3 text-center space-x-3">

                            <a href="{{ route('admin.estimates.show', $estimate->id) }}"
                               class="text-blue-600 hover:underline text-sm">
                                View
                            </a>

                            <form action="{{ route('admin.estimates.destroy', $estimate->id) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Delete this estimate?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline text-sm">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center p-6 text-gray-500">
                            No estimates found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>


    {{-- ================= MOBILE CARD VIEW ================= --}}
    <div class="md:hidden space-y-4">

        @forelse($estimates as $estimate)

            <div class="border rounded-lg p-4 shadow-sm">

                <div class="flex justify-between items-start mb-2">
                    <div>
                        <p class="font-semibold text-sm">
                            {{ $estimate->estimate_number }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ $estimate->client->name ?? '-' }}
                        </p>
                    </div>

                    @if($estimate->status == 'draft')
                                <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded text-xs">Draft</span>
                            @elseif($estimate->status == 'sent')
                                <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded text-xs">Sent</span>
                            @elseif($estimate->status == 'accepted')
                                <span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs">Accepted</span>
                            @elseif($estimate->status == 'rejected')
                                <span class="bg-red-200 text-red-800 px-2 py-1 rounded text-xs">Rejected</span>
                            @endif
                </div>

                <div class="text-xs text-gray-600 space-y-1">
                    <p><strong>Issue:</strong> {{ $estimate->issue_date }}</p>
                    <p><strong>Expiry:</strong> {{ $estimate->expiry_date ?? '-' }}</p>
                    <p class="font-semibold text-sm text-gray-800">
                        ₹ {{ number_format($estimate->total, 2) }}
                    </p>
                </div>

                <div class="flex justify-end gap-4 mt-3 text-sm">

                    <a href="{{ route('admin.estimates.show', $estimate->id) }}"
                       class="text-blue-600">
                        View
                    </a>

                    <form action="{{ route('admin.estimates.destroy', $estimate->id) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this estimate?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        @empty
            <div class="text-center text-gray-500 py-6">
                No estimates found.
            </div>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $estimates->links() }}
    </div>

</div>

@endsection