@extends('layouts.admin')

@section('content')

@php
$template = $estimate->template ?? 'classic';

/* Theme Classes */
$wrapperBg = match($template) {
    'modern' => 'bg-blue-50',
    'dark' => 'bg-gray-900 text-white',
    default => 'bg-white'
};

$headerBorder = match($template) {
    'modern' => 'border-b-4 border-blue-500',
    'dark' => 'border-b border-gray-700',
    default => 'border-b'
};

$tableHeadBg = match($template) {
    'modern' => 'bg-blue-100',
    'dark' => 'bg-gray-800 text-white',
    default => 'bg-gray-100'
};

$tableBorder = $template == 'dark'
    ? 'border border-gray-700'
    : 'border';
@endphp


{{-- Template Selector --}}
<div class="flex justify-end mb-6">
    <form action="{{ route('admin.estimates.changeTemplate', $estimate->id) }}" method="POST">
        @csrf
        <select name="template"
                onchange="this.form.submit()"
                class="border rounded px-3 py-2">
            @foreach(['classic','modern','minimal','dark','blue','corporate','elegant','creative','bold','clean'] as $tpl)
                <option value="{{ $tpl }}" {{ $template == $tpl ? 'selected' : '' }}>
                    {{ ucfirst($tpl) }}
                </option>
            @endforeach
        </select>
    </form>
</div>


<div class="max-w-5xl mx-auto p-8 rounded shadow {{ $wrapperBg }}">

    {{-- Header --}}
    <div class="flex justify-between items-start pb-6 mb-6 {{ $headerBorder }}">

        {{-- Company Info --}}
        <div>
            @if($setting->company_logo)
                <img src="{{ asset('storage/'.$setting->company_logo) }}"
                     class="h-16 mb-2">
            @endif

            <h1 class="text-2xl font-bold">
                {{ $setting->company_name }}
            </h1>

            <p class="text-sm opacity-70">
                {{ $setting->company_address }}
            </p>

            <p class="text-sm opacity-70">
                {{ $setting->company_email }} | {{ $setting->company_phone }}
            </p>
        </div>

        {{-- Estimate Info Box --}}
        <div class="text-right">
            <div class="bg-gray-100 p-4 rounded
                @if($template == 'dark') bg-gray-800 text-white @endif">
                <p class="text-sm opacity-70">Estimate #</p>
                <p class="text-lg font-semibold">{{ $estimate->estimate_number }}</p>

                <p class="mt-2 text-sm opacity-70">Issue Date</p>
                <p>{{ $estimate->issue_date }}</p>

                <p class="mt-2 text-sm opacity-70">Expiry Date</p>
                <p>{{ $estimate->expiry_date ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Client Info --}}
    <div class="mb-8">
        <h3 class="text-sm font-semibold uppercase mb-2 opacity-60">Bill To</h3>
        <p class="font-medium">{{ $estimate->client->name }}</p>
        <p class="text-sm opacity-70">{{ $estimate->client->email }}</p>
        <p class="text-sm opacity-70">{{ $estimate->client->phone }}</p>
        <p class="text-sm opacity-70">{{ $estimate->client->address }}</p>
    </div>

    {{-- Items Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm {{ $tableBorder }}">
            <thead class="{{ $tableHeadBg }}">
                <tr>
                    <th class="border p-3 text-left">Title</th>
                    <th class="border p-3 text-left">Description</th>
                    <th class="border p-3 text-right">Qty</th>
                    <th class="border p-3 text-right">Rate</th>
                    <th class="border p-3 text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estimate->items as $item)
                <tr>
                    <td class="border p-3">{{ $item->title }}</td>
                    <td class="border p-3">{{ $item->description }}</td>
                    <td class="border p-3 text-right">{{ $item->quantity }}</td>
                    <td class="border p-3 text-right">
                        ₹ {{ number_format($item->rate,2) }}
                    </td>
                    <td class="border p-3 text-right font-medium">
                        ₹ {{ number_format($item->amount,2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Summary --}}
    <div class="flex justify-end mt-8">
        <div class="w-80">

            <div class="flex justify-between py-2">
                <span>Subtotal</span>
                <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
            </div>

            <div class="flex justify-between py-2">
                <span>Tax ({{ $estimate->tax_percentage }}%)</span>
                <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
            </div>

            <div class="flex justify-between py-3 border-t font-bold text-lg">
                <span>Total</span>
                <span>₹ {{ number_format($estimate->total,2) }}</span>
            </div>

        </div>
    </div>

    {{-- Notes --}}
    @if($estimate->notes)
        <div class="mt-10 border-t pt-6 opacity-80">
            <h4 class="font-semibold mb-2">Notes</h4>
            <p class="text-sm">{{ $estimate->notes }}</p>
        </div>
    @endif

    {{-- Actions --}}
    <div class="mt-10 flex justify-end space-x-3">
        <a href="{{ route('admin.estimates.pdf', $estimate->id) }}"
           class="bg-green-600 text-white px-4 py-2 rounded">
            Download PDF
        </a>

        <a href="{{ route('admin.estimates.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">
            Back
        </a>
    </div>

</div>

@endsection
