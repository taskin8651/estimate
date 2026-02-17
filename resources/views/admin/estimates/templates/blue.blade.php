<div class="w-full bg-gray-100 py-4 px-3">

    <div class="w-full max-w-4xl mx-auto bg-white rounded-lg shadow overflow-hidden">

        {{-- ================= TOP HEADER ================= --}}
        <div class="bg-blue-600 text-white px-6 py-5 flex justify-between items-center">

            <div class="flex items-center gap-3">
                @if($setting->company_logo)
                    <img src="{{ asset('storage/'.$setting->company_logo) }}"
                         class="h-12 bg-white p-1 rounded">
                @endif

                <div class="text-sm hidden sm:block">
                    <h1 class="text-lg font-semibold">
                        {{ $setting->company_name }}
                    </h1>
                    <p class="text-xs text-blue-100">
                        Estimate Document
                    </p>
                </div>
            </div>

            <div class="text-right text-xs leading-5">
                <p class="font-medium">
                    {{ $setting->company_name }}
                </p>
                <p>{{ $setting->company_address }}</p>
                <p>{{ $setting->company_email }}</p>
                <p>{{ $setting->company_phone }}</p>
            </div>
        </div>


        {{-- ================= CLIENT + ESTIMATE ================= --}}
        <div class="grid grid-cols-2 gap-6 px-2 sm:px-6 py-5 border-b text-[11px]">

            {{-- CLIENT --}}
            <div>
                <h3 class="uppercase text-blue-600 font-semibold mb-2 text-[11px]">
                    Bill To
                </h3>

                <p class="font-semibold text-gray-800">
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

            {{-- ESTIMATE BOX --}}
            <div class="flex justify-end">
                <div class="w-55  p-1 sm:p-4 rounded border border-blue-200 bg-blue-50 text-[11px]">

                    <div class="flex justify-between mb-1">
                        <span class="text-blue-600">Estimate #</span>
                        <span>{{ $estimate->estimate_number }}</span>
                    </div>

                    <div class="flex justify-between mb-1">
                        <span class="text-blue-600">Issue</span>
                        <span>{{ $estimate->issue_date }}</span>
                    </div>

                    <div class="flex justify-between mb-1">
                        <span class="text-blue-600">Expiry</span>
                        <span>{{ $estimate->expiry_date ?? '-' }}</span>
                    </div>

                    <div class="border-t border-blue-200 mt-3 pt-2 text-right">
                        <p class="text-[10px] text-blue-600">Grand Total</p>
                        <p class="text-base font-semibold text-blue-700">
                            ₹ {{ number_format($estimate->total,2) }}
                        </p>
                    </div>

                </div>
            </div>

        </div>


        {{-- ================= TABLE ================= --}}
        <div class=" sm:px-6 py-5">

            <div class="overflow-x-auto">
                <table class="w-full text-xs border-collapse">

                    <thead class="bg-blue-600 text-white text-[12px]">
                        <tr>
                            <th class="p-2 text-left">Services</th>
                            <th class="p-2 text-right">Qty</th>
                            <th class="p-2 text-right">Rate</th>
                            <th class="p-2 text-right">Amount</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($estimate->items as $item)
                        <tr class="border-b border-gray-200">
                            <td class="p-2">
                                <p class="font-medium text-gray-800">
                                    {{ $item->title }}
                                </p>
                                <p class="text-[10px] text-gray-500">
                                    {{ $item->description }}
                                </p>
                            </td>

                            <td class="p-2 text-right">
                                {{ $item->quantity }}
                            </td>

                            <td class="p-2 text-right">
                                ₹ {{ number_format($item->rate,2) }}
                            </td>

                            <td class="p-2 text-right font-medium text-blue-600">
                                ₹ {{ number_format($item->amount,2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>


        {{-- ================= SUMMARY ================= --}}
        <div class="flex justify-end px-4 sm:px-6 pb-6">

            <div class="w-60 sm:w-64 text-xs">

                <div class="flex justify-between py-1">
                    <span>Subtotal</span>
                    <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
                </div>

                <div class="flex justify-between py-1">
                    <span>Vat ({{ $estimate->tax_percentage }}%)</span>
                    <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
                </div>

                <div class="flex justify-between py-2 border-t font-semibold text-sm text-blue-700">
                    <span>Total</span>
                    <span>₹ {{ number_format($estimate->total,2) }}</span>
                </div>

            </div>

        </div>


        {{-- ================= NOTES ================= --}}
        @if($estimate->notes)
        <div class="px-4 sm:px-6 py-6 border-t">

            <div class="bg-blue-50 border border-blue-200 rounded p-4">
                <h4 class="text-[11px] uppercase text-blue-600 font-semibold mb-2">
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
