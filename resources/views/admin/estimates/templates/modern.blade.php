@extends('layouts.admin')

@section('content')

<div class="max-w-5xl mx-auto bg-blue-50 p-8 rounded shadow">

    <div class="bg-blue-600 text-white p-6 rounded mb-6 flex justify-between">
        <div>
            <h1 class="text-2xl font-bold">
                {{ $setting->company_name }}
            </h1>
            <p class="text-sm opacity-80">
                {{ $setting->company_email }}
            </p>
        </div>

        <div class="text-right">
            <h2 class="text-xl font-semibold">Estimate</h2>
            <p>#{{ $estimate->estimate_number }}</p>
        </div>
    </div>

    <table class="w-full text-sm bg-white rounded overflow-hidden">
        <thead class="bg-blue-100">
            <tr>
                <th class="p-3 text-left">Service</th>
                <th class="p-3 text-right">Qty</th>
                <th class="p-3 text-right">Rate</th>
                <th class="p-3 text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estimate->items as $item)
            <tr class="border-t">
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
        <div class="bg-blue-600 text-white p-4 rounded w-72">
            <div class="flex justify-between">
                <span>Total</span>
                <span class="font-bold">
                    ₹ {{ number_format($estimate->total,2) }}
                </span>
            </div>
        </div>
    </div>

</div>

@endsection
