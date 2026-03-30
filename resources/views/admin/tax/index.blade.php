@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-6">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Taxes</h2>

        <a href="{{ route('admin.tax.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            + Add Tax
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="min-w-full divide-y divide-gray-200">

            <!-- Header -->
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Rate</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Country</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Default</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Action</th>
                </tr>
            </thead>

            <!-- Body -->
            <tbody class="divide-y divide-gray-100 bg-white">

                @forelse($taxes as $tax)

                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 text-sm text-gray-700">
                        {{ $tax->id }}
                    </td>

                    <td class="px-6 py-4 text-sm font-medium text-gray-800">
                        {{ $tax->name }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $tax->rate }}%
                    </td>

                    <!-- Type -->
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">
                            {{ $tax->type ?? '-' }}
                        </span>
                    </td>

                    <!-- Country -->
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-700">
                            {{ $tax->country ?? '-' }}
                        </span>
                    </td>

                    <!-- Default -->
                    <td class="px-6 py-4 text-sm">
                        @if($tax->is_default)
                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                Default
                            </span>
                        @else
                            <span class="text-gray-400 text-xs">No</span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 text-right space-x-2">

                        <a href="{{ route('admin.tax.edit',$tax->id) }}"
                           class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1.5 rounded-md transition">
                            Edit
                        </a>

                        <form action="{{ route('admin.tax.destroy',$tax->id) }}"
                              method="POST"
                              class="inline-block">
                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Delete this tax?')"
                                class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1.5 rounded-md transition">
                                Delete
                            </button>
                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-500">
                        No taxes found
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection