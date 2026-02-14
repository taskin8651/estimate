<div class="min-h-screen bg-black text-gray-200 py-14">

    <div class="max-w-6xl mx-auto border border-cyan-500 rounded-2xl shadow-2xl p-10">

        {{-- ================= HEADER ================= --}}
        <div class="flex justify-between items-center mb-10">

            <div>
                <h1 class="text-3xl font-bold text-cyan-400">
                    {{ $setting->company_name }}
                </h1>
                <p class="text-sm text-gray-500">
                    Estimate Document
                </p>
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
        <div class="grid grid-cols-2 gap-10 mb-10">

            <div>
                <h3 class="text-xs uppercase text-cyan-400 font-semibold mb-3">
                    Bill To
                </h3>

                <p class="font-semibold text-white">
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

            <div class="flex justify-end">
                <div class="w-72 p-6 border border-cyan-500 rounded-lg">

                    <div class="flex justify-between text-sm mb-2">
                        <span>Issue</span>
                        <span>{{ $estimate->issue_date }}</span>
                    </div>

                    <div class="flex justify-between text-sm mb-2">
                        <span>Expiry</span>
                        <span>{{ $estimate->expiry_date ?? '-' }}</span>
                    </div>

                    <div class="border-t border-cyan-500 mt-4 pt-3 text-right">
                        <p class="text-xs text-gray-500">Grand Total</p>
                        <p class="text-2xl font-bold text-cyan-400">
                            ₹ {{ number_format($estimate->total,2) }}
                        </p>
                    </div>

                </div>
            </div>

        </div>


        {{-- ================= TABLE ================= --}}
        <table class="w-full text-sm mb-10 border border-cyan-500">

            <thead class="bg-cyan-500 text-black">
                <tr>
                    <th class="p-4 text-left">Services</th>
                    <th class="p-4 text-right">Qty</th>
                    <th class="p-4 text-right">Rate</th>
                    <th class="p-4 text-right">Amount</th>
                </tr>
            </thead>

            <tbody>
                @foreach($estimate->items as $item)
                <tr class="border-t border-cyan-500">
                    <td class="p-4">
                        {{ $item->title }}
                    </td>
                    <td class="p-4 text-right">
                        {{ $item->quantity }}
                    </td>
                    <td class="p-4 text-right">
                        ₹ {{ number_format($item->rate,2) }}
                    </td>
                    <td class="p-4 text-right font-semibold text-cyan-400">
                        ₹ {{ number_format($item->amount,2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>


        {{-- ================= SUMMARY ================= --}}
        <div class="flex justify-end mb-10">

            <div class="w-72 border border-cyan-500 p-6 rounded-lg text-right">

                <p>Subtotal: ₹ {{ number_format($estimate->subtotal,2) }}</p>
                <p>Tax: ₹ {{ number_format($estimate->tax_amount,2) }}</p>

                <p class="text-2xl font-bold text-cyan-400 border-t border-cyan-500 pt-3 mt-3">
                    ₹ {{ number_format($estimate->total,2) }}
                </p>

            </div>

        </div>


        {{-- ================= NOTES ================= --}}
        @if($estimate->notes)
        <div class="border-t border-cyan-500 pt-6">
            <h4 class="text-xs uppercase text-cyan-400 font-semibold mb-3">
                Notes
            </h4>
            <p class="text-sm text-gray-400">
                {{ $estimate->notes }}
            </p>
        </div>
        @endif

    </div>

</div>
