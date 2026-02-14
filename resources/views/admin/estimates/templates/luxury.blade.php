<div class="max-w-6xl mx-auto bg-white rounded-xl shadow-xl overflow-hidden border border-yellow-200">

    {{-- ================= HEADER ================= --}}
    <div class="px-10 py-10 border-b border-yellow-200 flex justify-between items-center bg-gradient-to-r from-yellow-50 to-white">

        <div class="flex items-center gap-4">
            @if($setting->company_logo)
                <img src="{{ asset('storage/'.$setting->company_logo) }}"
                     class="h-14">
            @endif

            <div>
                <h1 class="text-3xl font-semibold text-gray-800 tracking-wide">
                    {{ $setting->company_name }}
                </h1>
                <p class="text-sm text-yellow-700 tracking-wider uppercase">
                    Premium Estimate
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


    {{-- ================= CLIENT SECTION ================= --}}
    <div class="grid grid-cols-2 gap-10 px-10 py-10 border-b border-yellow-200">

        <div>
            <h3 class="text-xs uppercase text-yellow-700 font-semibold mb-3 tracking-widest">
                Bill To
            </h3>

            <p class="font-semibold text-lg text-gray-800">
                {{ $estimate->client->name }}
            </p>

            <p class="text-sm text-gray-600">
                {{ $estimate->client->address }}
            </p>

            <p class="text-sm text-gray-600">
                {{ $estimate->client->email }}
            </p>

            <p class="text-sm text-gray-600">
                {{ $estimate->client->phone }}
            </p>
        </div>

        <div class="flex justify-end">
            <div class="w-80 p-6 border border-yellow-300 rounded-lg bg-yellow-50">

                <div class="flex justify-between text-sm mb-3">
                    <span class="text-gray-600">Issue Date</span>
                    <span>{{ $estimate->issue_date }}</span>
                </div>

                <div class="flex justify-between text-sm mb-3">
                    <span class="text-gray-600">Expiry Date</span>
                    <span>{{ $estimate->expiry_date ?? '-' }}</span>
                </div>

                <div class="border-t border-yellow-300 mt-4 pt-4 text-right">
                    <p class="text-xs uppercase text-gray-500 tracking-wide">
                        Grand Total
                    </p>
                    <p class="text-3xl font-bold text-yellow-700">
                        ₹ {{ number_format($estimate->total,2) }}
                    </p>
                </div>

            </div>
        </div>

    </div>


    {{-- ================= TABLE ================= --}}
    <div class="px-10 py-10">

        <table class="w-full text-sm border border-yellow-200">

            <thead class="bg-yellow-100 text-yellow-900">
                <tr>
                    <th class="p-4 border text-left">Services</th>
                    <th class="p-4 border text-right">Qty</th>
                    <th class="p-4 border text-right">Rate</th>
                    <th class="p-4 border text-right">Amount</th>
                </tr>
            </thead>

            <tbody>
                @foreach($estimate->items as $item)
                <tr class="border-t border-yellow-200 hover:bg-yellow-50 transition">

                    <td class="p-4">
                        <p class="font-medium text-gray-800">
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

                    <td class="p-4 text-right font-semibold text-yellow-700">
                        ₹ {{ number_format($item->amount,2) }}
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

    </div>


    {{-- ================= SUMMARY ================= --}}
    <div class="flex justify-end px-10 pb-10">

        <div class="w-80 space-y-3 border border-yellow-200 p-6 rounded-lg bg-yellow-50">

            <div class="flex justify-between text-sm">
                <span class="text-gray-600">Subtotal</span>
                <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
            </div>

            <div class="flex justify-between text-sm">
                <span class="text-gray-600">
                    Tax ({{ $estimate->tax_percentage }}%)
                </span>
                <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
            </div>

            <div class="flex justify-between border-t border-yellow-300 pt-4 text-xl font-bold text-yellow-700">
                <span>Total</span>
                <span>₹ {{ number_format($estimate->total,2) }}</span>
            </div>

        </div>

    </div>


    {{-- ================= NOTES ================= --}}
    @if($estimate->notes)
    <div class="px-10 pb-10 border-t border-yellow-200">

        <h4 class="text-xs uppercase text-yellow-700 font-semibold mb-3 tracking-widest">
            Notes
        </h4>

        <p class="text-sm text-gray-700 leading-relaxed">
            {{ $estimate->notes }}
        </p>

    </div>
    @endif

</div>
