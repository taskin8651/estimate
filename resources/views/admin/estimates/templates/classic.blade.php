<div class="w-full bg-gray-100 py-4 px-3">

    <div class="w-full max-w-4xl mx-auto bg-white rounded-lg shadow overflow-hidden">

        {{-- ================= TOP HEADER ================= --}}
        <div class="flex justify-between items-center px-6 py-5 border-b">

            <div class="flex items-center gap-3">
                @if($setting->company_logo)
                    <img src="{{ asset('storage/'.$setting->company_logo) }}"
                         class="h-12">
                @endif

                <div class="text-sm hidden sm:block">
                    <h1 class="text-xl font-semibold">
                        {{ $setting->company_name }}
                    </h1>
                    <p class="text-xs text-gray-500">
                        Estimate Document
                    </p>
                </div>
            </div>

            <div class="text-right text-xs text-gray-600 leading-5 ">
                <p class="font-medium text-gray-800">
                    {{ $setting->company_name }}
                </p>
                <p>{{ $setting->company_address }}</p>
                <p>{{ $setting->company_email }}</p>
                <p>{{ $setting->company_phone }}</p>
            </div>
        </div>


        {{-- ================= CLIENT + ESTIMATE ================= --}}
        <div class="grid grid-cols-2 gap-6 px-sm-6 px-2 py-5 border-b text-[11px]">

            <div>
                <h3 class="text-[11px] uppercase text-gray-500 font-semibold mb-2">
                    Bill To
                </h3>

                <p class="font-semibold">
                    {{ $estimate->client->name }}
                </p>

                <p class="text-xs text-gray-600">
                    {{ $estimate->client->address }}
                </p>

                <p class="text-xs text-gray-600">
                    {{ $estimate->client->email }}
                </p>

                <p class="text-xs text-gray-600">
                    {{ $estimate->client->phone }}
                </p>
            </div>

            <div class="flex justify-end">
                <div class="w-64 p-sm-4 p-2 rounded bg-gray-50 border text-[11px]">

                    <div class="flex justify-between mb-1">
                        <span>Estimate #</span>
                        <span>{{ $estimate->estimate_number }}</span>
                    </div>

                    <div class="flex justify-between mb-1">
                        <span>Issue Date</span>
                        <span>{{ $estimate->issue_date }}</span>
                    </div>

                    <div class="flex justify-between mb-1">
                        <span>Expiry</span>
                        <span>{{ $estimate->expiry_date ?? '-' }}</span>
                    </div>

                    <div class="border-t mt-3 pt-2 text-right">
                        <p class="text-[11px] text-gray-500">Grand Total</p>
                        <p class="text-base font-semibold">
                            ₹ {{ number_format($estimate->total,2) }}
                        </p>
                    </div>

                </div>
            </div>

        </div>


        {{-- ================= TABLE ================= --}}
        <div class="px-sm-6 px-2 py-5">

            <div class="overflow-x-auto">
                <table class="w-full text-xs border-collapse">

                    <thead class="bg-purple-600 text-white text-[12px]">
                        <tr>
                            <th class="p-2 text-left">Services</th>
                            <th class="p-2 text-right">Qty</th>
                            <th class="p-2 text-right">Rate</th>
                            <th class="p-2 text-right">Amount</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($estimate->items as $item)
                        <tr class="border-b">
                            <td class="p-2">
                                <p class="font-medium">
                                    {{ $item->title }}
                                </p>
                                <p class="text-[11px] text-gray-500">
                                    {{ $item->description }}
                                </p>
                            </td>

                            <td class="p-2 text-right">
                                {{ $item->quantity }}
                            </td>

                            <td class="p-2 text-right">
                                ₹ {{ number_format($item->rate,2) }}
                            </td>

                            <td class="p-2 text-right font-medium">
                                ₹ {{ number_format($item->amount,2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>


        {{-- ================= SUMMARY ================= --}}
        <div class="flex justify-end px-6 pb-6  text-sm">

            <div class="w-64 text-xs">

                <div class="flex justify-between py-1">
                    <span>Subtotal</span>
                    <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
                </div>

                <div class="flex justify-between py-1">
                    <span>Vat ({{ $estimate->tax_percentage }}%)</span>
                    <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
                </div>

                <div class="flex justify-between py-2 border-t font-semibold text-sm">
                    <span>Total</span>
                    <span>₹ {{ number_format($estimate->total,2) }}</span>
                </div>

            </div>

        </div>


        {{-- ================= NOTES ================= --}}
        @if($estimate->notes)
        <div class="px-6 py-6 border-t ">

            <div class="bg-gray-50 border rounded p-4">
                <h4 class="text-[11px] uppercase text-gray-500 font-semibold mb-2">
                    Notes
                </h4>

                <p class="text-xs text-gray-700 leading-relaxed">
                    {{ $estimate->notes }}
                </p>
            </div>

        </div>
        @endif

    </div>

</div>
