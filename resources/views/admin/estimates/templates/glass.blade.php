<div class="min-h-screen bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 py-14">

    <div class="max-w-6xl mx-auto backdrop-blur-xl bg-white/70 rounded-2xl shadow-2xl p-10 border border-white/40">

        {{-- ================= HEADER ================= --}}
        <div class="flex justify-between items-center mb-10">

            <div class="flex items-center gap-4">
                @if($setting->company_logo)
                    <img src="{{ asset('storage/'.$setting->company_logo) }}"
                         class="h-14 rounded-md">
                @endif

                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">
                        {{ $setting->company_name }}
                    </h1>
                    <p class="text-sm text-gray-500">
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


        {{-- ================= CLIENT + ESTIMATE ================= --}}
        <div class="grid grid-cols-2 gap-10 mb-10">

            <div>
                <h3 class="text-xs uppercase text-gray-500 font-semibold mb-3">
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

            <div class="flex justify-end">
                <div class="w-72 p-6 bg-white/60 rounded-xl border border-white/40 shadow">

                    <div class="flex justify-between text-sm mb-2">
                        <span>Issue Date</span>
                        <span>{{ $estimate->issue_date }}</span>
                    </div>

                    <div class="flex justify-between text-sm mb-2">
                        <span>Expiry</span>
                        <span>{{ $estimate->expiry_date ?? '-' }}</span>
                    </div>

                    <div class="border-t mt-4 pt-3 text-right">
                        <p class="text-xs text-gray-500">Grand Total</p>
                        <p class="text-xl font-bold text-purple-600">
                            ₹ {{ number_format($estimate->total,2) }}
                        </p>
                    </div>

                </div>
            </div>

        </div>


        {{-- ================= TABLE ================= --}}
        <table class="w-full text-sm mb-10">

            <thead class="border-b border-gray-300 text-gray-600">
                <tr>
                    <th class="py-3 text-left">Services</th>
                    <th class="py-3 text-right">Qty</th>
                    <th class="py-3 text-right">Rate</th>
                    <th class="py-3 text-right">Amount</th>
                </tr>
            </thead>

            <tbody>
                @foreach($estimate->items as $item)
                <tr class="border-b border-white/40">
                    <td class="py-4">
                        <p class="font-medium text-gray-800">
                            {{ $item->title }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ $item->description }}
                        </p>
                    </td>

                    <td class="py-4 text-right">
                        {{ $item->quantity }}
                    </td>

                    <td class="py-4 text-right">
                        ₹ {{ number_format($item->rate,2) }}
                    </td>

                    <td class="py-4 text-right font-semibold">
                        ₹ {{ number_format($item->amount,2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>


        {{-- ================= SUMMARY ================= --}}
        <div class="flex justify-end mb-10">

            <div class="w-72 space-y-2 text-right">
                <p>Subtotal: ₹ {{ number_format($estimate->subtotal,2) }}</p>
                <p>Tax: ₹ {{ number_format($estimate->tax_amount,2) }}</p>

                <p class="text-xl font-bold text-purple-600 border-t pt-2">
                    ₹ {{ number_format($estimate->total,2) }}
                </p>
            </div>

        </div>


        {{-- ================= NOTES ================= --}}
        @if($estimate->notes)
        <div class="border-t pt-6">
            <h4 class="text-xs uppercase text-gray-500 font-semibold mb-3">
                Notes
            </h4>
            <p class="text-sm text-gray-700">
                {{ $estimate->notes }}
            </p>
        </div>
        @endif

    </div>

</div>
