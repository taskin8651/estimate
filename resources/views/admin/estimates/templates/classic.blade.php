@extends('layouts.admin')

@section('content')

<div class="max-w-5xl mx-auto bg-white p-8 rounded shadow">

    {{-- Header --}}
    <div class="flex justify-between border-b pb-6 mb-6">

        <div>
            @if($setting->company_logo)
                <img src="{{ asset('storage/'.$setting->company_logo) }}" class="h-14 mb-2">
            @endif

            <h1 class="text-2xl font-bold text-gray-800">
                {{ $setting->company_name }}
            </h1>
            <p class="text-sm text-gray-600">
                {{ $setting->company_address }}
            </p>
            <p class="text-sm text-gray-600">
                {{ $setting->company_email }} | {{ $setting->company_phone }}
            </p>
        </div>

        <div class="text-right">
            <h2 class="text-xl font-semibold">ESTIMATE</h2>
            <p>#{{ $estimate->estimate_number }}</p>
            <p>Date: {{ $estimate->issue_date }}</p>
            <p>Expiry: {{ $estimate->expiry_date }}</p>
        </div>
    </div>

    {{-- Items --}}
    <table class="w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-3 text-left">Title</th>
                <th class="border p-3 text-right">Qty</th>
                <th class="border p-3 text-right">Rate</th>
                <th class="border p-3 text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estimate->items as $item)
            <tr>
                <td class="border p-3">{{ $item->title }}</td>
                <td class="border p-3 text-right">{{ $item->quantity }}</td>
                <td class="border p-3 text-right">₹ {{ number_format($item->rate,2) }}</td>
                <td class="border p-3 text-right font-semibold">
                    ₹ {{ number_format($item->amount,2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Total --}}
    <div class="flex justify-end mt-6">
        <div class="w-64 text-right">
            <p>Subtotal: ₹ {{ number_format($estimate->subtotal,2) }}</p>
            <p>Tax: ₹ {{ number_format($estimate->tax_amount,2) }}</p>
            <p class="text-lg font-bold border-t pt-2">
                Total: ₹ {{ number_format($estimate->total,2) }}
            </p>
        </div>
    </div>

</div>

@endsection
