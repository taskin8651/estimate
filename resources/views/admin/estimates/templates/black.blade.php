@extends('layouts.admin')

@section('content')

<div class="relative max-w-6xl mx-auto rounded shadow-2xl overflow-hidden 
bg-gradient-to-br from-gray-900 via-black to-gray-800 text-white">

    {{-- Decorative Gradient Circles --}}
    <div class="absolute -top-24 -left-24 w-80 h-80 bg-purple-600 opacity-20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-pink-500 opacity-20 rounded-full blur-3xl"></div>

    <div class="relative z-10">

        {{-- ================= TOP HEADER ================= --}}
        <div class="flex justify-between items-center px-10 py-8 border-b border-gray-700">

            {{-- LEFT: Logo + Name --}}
            <div class="flex items-center gap-4">
                @if($setting->company_logo)
                    <img src="{{ asset('storage/'.$setting->company_logo) }}" class="h-16">
                @endif

                <div>
                    <h1 class="text-3xl font-semibold">
                        {{ $setting->company_name }}
                    </h1>
                    <p class="text-sm text-gray-400">
                        Estimate Document
                    </p>
                </div>
            </div>

            {{-- RIGHT: Company Details --}}
            <div class="text-right text-sm text-gray-400 leading-6">
                <p class="font-semibold text-white">
                    {{ $setting->company_name }}
                </p>
                <p>{{ $setting->company_address }}</p>
                <p>{{ $setting->company_email }}</p>
                <p>{{ $setting->company_phone }}</p>
            </div>
        </div>


        {{-- ================= CLIENT + ESTIMATE ================= --}}
        <div class="grid grid-cols-2 gap-10 px-10 py-8 border-b border-gray-700">

            {{-- CLIENT --}}
            <div>
                <h3 class="text-xs uppercase text-gray-400 font-semibold mb-3">
                    Bill To
                </h3>

                <p class="font-semibold text-lg">
                    {{ $estimate->client->name }}
                </p>

                <p class="text-sm text-gray-400">
                    {{ $estimate->client->address }}
                </p>

                <p class="text-sm text-gray-400">
                    {{ $estimate->client->email }}
                </p>

                <p class="text-sm text-gray-400">
                    {{ $estimate->client->phone }}
                </p>
            </div>

            {{-- ESTIMATE INFO --}}
            <div class="flex justify-end">
                <div class="w-72 p-6 rounded-lg 
                bg-gray-800 bg-opacity-60 backdrop-blur 
                border border-gray-700 shadow-lg">

                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-400">Estimate #:</span>
                        <span class="font-medium">{{ $estimate->estimate_number }}</span>
                    </div>

                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-400">Issue Date:</span>
                        <span>{{ $estimate->issue_date }}</span>
                    </div>

                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-400">Expiry Date:</span>
                        <span>{{ $estimate->expiry_date ?? '-' }}</span>
                    </div>

                    <div class="border-t border-gray-600 mt-4 pt-4 text-right">
                        <p class="text-xs text-gray-400">Grand Total</p>
                        <p class="text-xl font-bold text-white">
                            ₹ {{ number_format($estimate->total,2) }}
                        </p>
                    </div>

                </div>
            </div>

        </div>


        {{-- ================= ITEMS TABLE ================= --}}
        <div class="px-10 py-8">

            <table class="w-full text-sm border-collapse">

                <thead class="bg-gradient-to-r from-purple-600 to-pink-500 text-white">
                    <tr>
                        <th class="p-4 text-left">Services</th>
                        <th class="p-4 text-right">Qty</th>
                        <th class="p-4 text-right">Rate</th>
                        <th class="p-4 text-right">Amount</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($estimate->items as $item)
                    <tr class="border-b border-gray-700">
                        <td class="p-4">
                            <p class="font-medium text-white">
                                {{ $item->title }}
                            </p>
                            <p class="text-xs text-gray-400">
                                {{ $item->description }}
                            </p>
                        </td>

                        <td class="p-4 text-right">
                            {{ $item->quantity }}
                        </td>

                        <td class="p-4 text-right">
                            ₹ {{ number_format($item->rate,2) }}
                        </td>

                        <td class="p-4 text-right font-semibold">
                            ₹ {{ number_format($item->amount,2) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>


        {{-- ================= SUMMARY ================= --}}
        <div class="flex justify-end px-10 pb-10">

            <div class="w-80">

                <div class="flex justify-between py-2 text-sm">
                    <span class="text-gray-400">Subtotal:</span>
                    <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
                </div>

                <div class="flex justify-between py-2 text-sm">
                    <span class="text-gray-400">
                        Vat ({{ $estimate->tax_percentage }}%):
                    </span>
                    <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
                </div>

                <div class="flex justify-between py-3 border-t border-gray-600 font-bold text-lg">
                    <span>Total:</span>
                    <span>₹ {{ number_format($estimate->total,2) }}</span>
                </div>

            </div>

        </div>


        {{-- ================= NOTES ================= --}}
        @if($estimate->notes)
        <div class="px-10 pb-10">

            <div class="bg-gray-800 bg-opacity-60 backdrop-blur 
            border border-gray-700 rounded-lg p-6">

                <h4 class="text-sm uppercase text-gray-400 font-semibold mb-3">
                    Notes
                </h4>

                <p class="text-sm text-gray-300 leading-relaxed">
                    {{ $estimate->notes }}
                </p>

            </div>

        </div>
        @endif

    </div> {{-- relative z-10 --}}
</div>

@endsection
