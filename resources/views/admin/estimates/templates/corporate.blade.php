<div class="w-full bg-gray-100 py-4 px-3">

    <div class="w-full max-w-4xl mx-auto bg-white border border-gray-300 rounded-lg shadow-sm overflow-hidden">


        {{-- ================= TOP HEADER ================= --}}
        <div class="px-6 py-6 border-b border-gray-300 flex justify-between items-center">

            <div class="flex items-center gap-3">
                @if($setting->company_logo)
                    <img src="{{ asset('storage/'.$setting->company_logo) }}"
                         class="h-12">
                @endif

                <div class="text-sm hidden sm:block">
                    <h1 class="text-lg font-bold text-gray-800 uppercase tracking-wide">
                        {{ $setting->company_name }}
                    </h1>
                    <p class="text-xs text-gray-500">
                        {{ $setting->company_address }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $setting->company_email }} | {{ $setting->company_phone }}
                    </p>
                </div>
            </div>

            <div class="text-right text-xs text-gray-600 leading-5">
                <p class="font-medium text-gray-800">
                    {{ $setting->company_name }}
                </p>
                <p>{{ $setting->company_address }}</p>
                <p>{{ $setting->company_email }}</p>
                <p>{{ $setting->company_phone }}</p>
            </div>

        </div>


        {{-- ================= CLIENT + ESTIMATE ================= --}}
        <div class="grid grid-cols-2 gap-6 px-4 sm:px-6 py-5 border-b border-gray-300 text-[11px]">

            {{-- CLIENT --}}
            <div>
                <h3 class="uppercase text-gray-600 font-semibold mb-2 tracking-wide text-[11px]">
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
                <div class="w-60 sm:w-64 p-4 border border-gray-300 bg-gray-50 text-[11px]">

                    <div class="flex justify-between mb-1">
                        <span class="text-gray-600">Estimate #</span>
                        <span class="font-medium">{{ $estimate->estimate_number }}</span>
                    </div>

                    <div class="flex justify-between mb-1">
                        <span class="text-gray-600">Issue Date</span>
                        <span>{{ $estimate->issue_date }}</span>
                    </div>

                    <div class="flex justify-between mb-1">
                        <span class="text-gray-600">Expiry Date</span>
                        <span>{{ $estimate->expiry_date ?? '-' }}</span>
                    </div>

                    <div class="border-t border-gray-300 mt-3 pt-2 text-right">
                        <p class="text-[10px] text-gray-600">Grand Total</p>
                        <p class="text-base font-bold text-gray-800">
                            ₹ {{ number_format($estimate->total,2) }}
                        </p>
                    </div>

                </div>
            </div>

        </div>


        {{-- ================= TABLE ================= --}}
        <div class="px-4 sm:px-6 py-5">

            <div class="overflow-x-auto">
                <table class="w-full text-xs border border-gray-300 border-collapse">

                    <thead class="bg-gray-100 text-[12px]">
                        <tr>
                            <th class="p-2 border text-left font-semibold text-gray-700">
                                Services
                            </th>
                            <th class="p-2 border text-right font-semibold text-gray-700">
                                Qty
                            </th>
                            <th class="p-2 border text-right font-semibold text-gray-700">
                                Rate
                            </th>
                            <th class="p-2 border text-right font-semibold text-gray-700">
                                Amount
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($estimate->items as $item)
                        <tr>
                            <td class="p-2 border">
                                <p class="font-medium text-gray-800">
                                    {{ $item->title }}
                                </p>
                                <p class="text-[10px] text-gray-500">
                                    {{ $item->description }}
                                </p>
                            </td>

                            <td class="p-2 border text-right">
                                {{ $item->quantity }}
                            </td>

                            <td class="p-2 border text-right">
                                ₹ {{ number_format($item->rate,2) }}
                            </td>

                            <td class="p-2 border text-right font-semibold">
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

            <div class="w-60 sm:w-64 border border-gray-300 p-4 bg-gray-50 text-xs">

                <div class="flex justify-between py-1">
                    <span class="text-gray-600">Subtotal</span>
                    <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
                </div>

                <div class="flex justify-between py-1">
                    <span class="text-gray-600">
                        Vat ({{ $estimate->tax_percentage }}%)
                    </span>
                    <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
                </div>

                <div class="flex justify-between py-2 border-t border-gray-300 font-bold text-sm text-gray-800">
                    <span>Total</span>
                    <span>₹ {{ number_format($estimate->total,2) }}</span>
                </div>

            </div>

        </div>


        {{-- ================= NOTES ================= --}}
        @if($estimate->notes)
        <div class="px-4 sm:px-6 pb-6 border-t border-gray-300">

            <h4 class="uppercase text-gray-600 font-semibold mb-2 tracking-wide text-[11px]">
                Notes
            </h4>

            <p class="text-xs text-gray-700">
                {{ $estimate->notes }}
            </p>

        </div>
        @endif

    </div>

</div>
