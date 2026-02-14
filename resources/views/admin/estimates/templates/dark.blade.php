@extends('layouts.admin')

@section('content')

<div class="max-w-5xl mx-auto bg-gray-900 text-white p-8 rounded shadow">

    <div class="flex justify-between border-b border-gray-700 pb-6 mb-6">

        <div>
            <h1 class="text-2xl font-bold">
                {{ $setting->company_name }}
            </h1>
            <p class="text-sm opacity-70">
                {{ $setting->company_email }}
            </p>
        </div>

        <div class="text-right">
            <h2 class="text-xl">Estimate</h2>
            <p>#{{ $estimate->estimate_number }}</p>
        </div>

    </div>

    <table class="w-full text-sm border border-gray-700">
        <thead class="bg-gray-800">
            <tr>
                <th class="p-3 text-left">Title</th>
                <th class="p-3 text-right">Qty</th>
                <th class="p-3 text-right">Rate</th>
                <th class="p-3 text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estimate->items as $item)
            <tr class="border-t border-gray-700">
                <td class="p-3">{{ $item->title }}</td>
                <td class="p-3 text-right">{{ $item->quantity }}</td>
                <td class="p-3 text-right">₹ {{ number_format($item->rate,2) }}</td>
                <td class="p-3 text-right font-semibold">
                    ₹ {{ number_format($item->amount,2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="flex justify-end mt-6">
        <div class="text-right">
            <p>Subtotal: ₹ {{ number_format($estimate->subtotal,2) }}</p>
            <p>Tax: ₹ {{ number_format($estimate->tax_amount,2) }}</p>
            <p class="text-xl font-bold border-t border-gray-700 pt-2">
                ₹ {{ number_format($estimate->total,2) }}
            </p>
        </div>
    </div>

</div>

@endsection
