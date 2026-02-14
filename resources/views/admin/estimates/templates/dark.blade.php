<div class="max-w-6xl mx-auto bg-gray-900 text-gray-200 rounded-xl shadow-2xl overflow-hidden">

    {{-- ================= HEADER ================= --}}
    <div class="px-10 py-8 border-b border-gray-700 flex justify-between items-center">

        <div class="flex items-center gap-4">
            @if($setting->company_logo)
                <img src="{{ asset('storage/'.$setting->company_logo) }}"
                     class="h-14 bg-white p-1 rounded">
            @endif

            <div>
                <h1 class="text-2xl font-semibold text-white">
                    {{ $setting->company_name }}
                </h1>
                <p class="text-sm text-gray-400">
                    Estimate Document
                </p>
            </div>
        </div>

        <div class="text-right">
            <p class="font-semibold text-gray-800">
                {{ $setting->company_name }}
            </p>
            <p>{{ $setting->company_address }}</p>
            <p>{{ $setting->company_email }}</p>
            <p>{{ $setting->company_phone }}</p>
        </div>

    </div>


    {{-- ================= CLIENT + ESTIMATE INFO ================= --}}
    <div class="grid grid-cols-2 gap-10 px-10 py-8 border-b border-gray-700">

        {{-- CLIENT --}}
        <div>
            <h3 class="text-xs uppercase text-gray-500 font-semibold mb-3 tracking-wide">
                Bill To
            </h3>

            <p class="font-semibold text-white text-lg">
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

        {{-- ESTIMATE BOX --}}
        <div class="flex justify-end">
            <div class="w-80 bg-gray-800 rounded-lg p-6 border border-gray-700">

                <div class="flex justify-between text-sm mb-3">
                    <span class="text-gray-500">Estimate #</span>
                    <span class="text-white">{{ $estimate->estimate_number }}</span>
                </div>

                <div class="flex justify-between text-sm mb-3">
                    <span class="text-gray-500">Issue Date</span>
                    <span>{{ $estimate->issue_date }}</span>
                </div>

                <div class="flex justify-between text-sm mb-3">
                    <span class="text-gray-500">Expiry Date</span>
                    <span>{{ $estimate->expiry_date ?? '-' }}</span>
                </div>

                <div class="border-t border-gray-700 mt-4 pt-4 text-right">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">
                        Grand Total
                    </p>
                    <p class="text-2xl font-bold text-indigo-400">
                        ₹ {{ number_format($estimate->total,2) }}
                    </p>
                </div>

            </div>
        </div>

    </div>


    {{-- ================= TABLE ================= --}}
    <div class="px-10 py-8">

        <table class="w-full text-sm border-collapse">

            <thead class="bg-gray-800 text-gray-300">
                <tr>
                    <th class="p-4 text-left font-semibold">Services</th>
                    <th class="p-4 text-right font-semibold">Qty</th>
                    <th class="p-4 text-right font-semibold">Rate</th>
                    <th class="p-4 text-right font-semibold">Amount</th>
                </tr>
            </thead>

            <tbody>
                @foreach($estimate->items as $item)
                <tr class="border-b border-gray-800 hover:bg-gray-800 transition">

                    <td class="p-4">
                        <p class="font-medium text-white">
                            {{ $item->title }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ $item->description }}
                        </p>
                    </td>

                    <td class="p-4 text-right">
                        {{ $item->quantity }}
                    </td>

                    <td class="p-4 text-right">
                        ₹ {{ number_format($item->rate,2) }}
                    </td>

                    <td class="p-4 text-right font-semibold text-indigo-400">
                        ₹ {{ number_format($item->amount,2) }}
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

    </div>


    {{-- ================= SUMMARY ================= --}}
    <div class="flex justify-end px-10 pb-10">

        <div class="w-80 space-y-3">

            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Subtotal</span>
                <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
            </div>

            <div class="flex justify-between text-sm">
                <span class="text-gray-400">
                    Tax ({{ $estimate->tax_percentage }}%)
                </span>
                <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
            </div>

            <div class="flex justify-between border-t border-gray-700 pt-4 text-xl font-bold text-indigo-400">
                <span>Total</span>
                <span>₹ {{ number_format($estimate->total,2) }}</span>
            </div>

        </div>

    </div>


    {{-- ================= NOTES ================= --}}
    @if($estimate->notes)
    <div class="px-10 pb-10 border-t border-gray-700">

        <h4 class="text-xs uppercase text-gray-500 font-semibold mb-3 tracking-wide">
            Notes
        </h4>

        <p class="text-sm text-gray-300 leading-relaxed">
            {{ $estimate->notes }}
        </p>

    </div>
    @endif

</div>
