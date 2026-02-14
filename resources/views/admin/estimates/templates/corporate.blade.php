<div class="max-w-6xl mx-auto bg-white border border-gray-300 rounded shadow-sm overflow-hidden">

    {{-- ================= TOP HEADER ================= --}}
    <div class="px-10 py-8 border-b border-gray-300 flex justify-between items-center">

        <div class="flex items-center gap-4">
            @if($setting->company_logo)
                <img src="{{ asset('storage/'.$setting->company_logo) }}" class="h-14">
            @endif

            <div>
                <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">
                    {{ $setting->company_name }}
                </h1>
                <p class="text-sm text-gray-500">
                    {{ $setting->company_address }}
                </p>
                <p class="text-sm text-gray-500">
                    {{ $setting->company_email }} | {{ $setting->company_phone }}
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


    {{-- ================= CLIENT + ESTIMATE ================= --}}
    <div class="grid grid-cols-2 gap-10 px-10 py-8 border-b border-gray-300">

        {{-- CLIENT --}}
        <div>
            <h3 class="text-xs uppercase text-gray-500 font-semibold mb-3 tracking-wide">
                Bill To
            </h3>

            <p class="font-semibold text-gray-800">
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

        {{-- ESTIMATE BOX --}}
        <div class="flex justify-end">
            <div class="w-80 p-6 border border-gray-300 bg-gray-50">

                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-600">Estimate #</span>
                    <span class="font-medium">{{ $estimate->estimate_number }}</span>
                </div>

                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-600">Issue Date</span>
                    <span>{{ $estimate->issue_date }}</span>
                </div>

                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-600">Expiry Date</span>
                    <span>{{ $estimate->expiry_date ?? '-' }}</span>
                </div>

                <div class="border-t border-gray-300 mt-4 pt-3 text-right">
                    <p class="text-xs text-gray-600">Grand Total</p>
                    <p class="text-lg font-bold text-gray-800">
                        ₹ {{ number_format($estimate->total,2) }}
                    </p>
                </div>

            </div>
        </div>

    </div>


    {{-- ================= TABLE ================= --}}
    <div class="px-10 py-8">

        <table class="w-full text-sm border border-gray-300">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border text-left font-semibold text-gray-700">Services</th>
                    <th class="p-3 border text-right font-semibold text-gray-700">Qty</th>
                    <th class="p-3 border text-right font-semibold text-gray-700">Rate</th>
                    <th class="p-3 border text-right font-semibold text-gray-700">Amount</th>
                </tr>
            </thead>

            <tbody>
                @foreach($estimate->items as $item)
                <tr>
                    <td class="p-3 border">
                        <p class="font-medium text-gray-800">
                            {{ $item->title }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ $item->description }}
                        </p>
                    </td>

                    <td class="p-3 border text-right">
                        {{ $item->quantity }}
                    </td>

                    <td class="p-3 border text-right">
                        ₹ {{ number_format($item->rate,2) }}
                    </td>

                    <td class="p-3 border text-right font-semibold">
                        ₹ {{ number_format($item->amount,2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>


    {{-- ================= SUMMARY ================= --}}
    <div class="flex justify-end px-10 pb-10">

        <div class="w-80 border border-gray-300 p-6 bg-gray-50">

            <div class="flex justify-between text-sm mb-2">
                <span class="text-gray-600">Subtotal</span>
                <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
            </div>

            <div class="flex justify-between text-sm mb-2">
                <span class="text-gray-600">
                    Tax ({{ $estimate->tax_percentage }}%)
                </span>
                <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
            </div>

            <div class="flex justify-between border-t border-gray-300 pt-3 text-lg font-bold text-gray-800">
                <span>Total</span>
                <span>₹ {{ number_format($estimate->total,2) }}</span>
            </div>

        </div>

    </div>


    {{-- ================= NOTES ================= --}}
    @if($estimate->notes)
    <div class="px-10 pb-10 border-t border-gray-300">

        <h4 class="text-xs uppercase text-gray-600 font-semibold mb-3 tracking-wide">
            Notes
        </h4>

        <p class="text-sm text-gray-700">
            {{ $estimate->notes }}
        </p>

    </div>
    @endif

</div>
