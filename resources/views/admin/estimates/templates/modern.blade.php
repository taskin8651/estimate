<div class="w-full bg-gray-100 py-4 px-3">

    <div class="w-full max-w-4xl mx-auto 
                bg-white rounded-lg shadow-lg overflow-hidden">


        {{-- ================= GRADIENT HEADER ================= --}}
        <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 
                    text-white px-6 py-6 
                    flex justify-between items-center">

            <div class="flex items-center gap-3">
                @if($setting->company_logo)
                    <img src="{{ asset('storage/'.$setting->company_logo) }}"
                         class="h-12 bg-white p-1 rounded">
                @endif

                <div class="hidden sm:block">
                    <h1 class="text-lg font-semibold">
                        {{ $setting->company_name }}
                    </h1>
                    <p class="text-xs opacity-80">
                        Estimate Document
                    </p>
                </div>
            </div>

            <div class="text-right text-xs leading-5 opacity-90">
                <p class="font-medium">
                    {{ $setting->company_name }}
                </p>
                <p>{{ $setting->company_address }}</p>
                <p>{{ $setting->company_email }}</p>
                <p>{{ $setting->company_phone }}</p>
            </div>

        </div>


        {{-- ================= CLIENT + ESTIMATE INFO ================= --}}
        <div class="grid grid-cols-2 gap-6 
                    px-4 sm:px-6 py-6 
                    border-b border-gray-200 text-[11px]">

            {{-- CLIENT --}}
            <div>
                <h3 class="uppercase text-gray-500 font-semibold mb-2 tracking-wide text-[11px]">
                    Bill To
                </h3>

                <p class="font-semibold text-gray-800 text-base">
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
                <div class="w-60 sm:w-64 
                            bg-gray-50 rounded-lg shadow-sm 
                            p-4 text-[11px]">

                    <div class="flex justify-between mb-1">
                        <span class="text-gray-500">Estimate #</span>
                        <span class="font-medium">
                            {{ $estimate->estimate_number }}
                        </span>
                    </div>

                    <div class="flex justify-between mb-1">
                        <span class="text-gray-500">Issue Date</span>
                        <span>{{ $estimate->issue_date }}</span>
                    </div>

                    <div class="flex justify-between mb-1">
                        <span class="text-gray-500">Expiry Date</span>
                        <span>{{ $estimate->expiry_date ?? '-' }}</span>
                    </div>

                    <div class="border-t mt-3 pt-2 text-right">
                        <p class="text-[10px] uppercase tracking-wide text-gray-500">
                            Grand Total
                        </p>
                        <p class="text-xl font-bold text-indigo-600">
                            ₹ {{ number_format($estimate->total,2) }}
                        </p>
                    </div>

                </div>
            </div>

        </div>


        {{-- ================= TABLE ================= --}}
        <div class="px-4 sm:px-6 py-6">

            <div class="overflow-x-auto">
                <table class="w-full text-xs border-collapse">

                    <thead class="bg-gray-100 text-[12px]">
                        <tr>
                            <th class="p-2 text-left font-semibold text-gray-700">
                                Services
                            </th>
                            <th class="p-2 text-right font-semibold text-gray-700">
                                Qty
                            </th>
                            <th class="p-2 text-right font-semibold text-gray-700">
                                Rate
                            </th>
                            <th class="p-2 text-right font-semibold text-gray-700">
                                Amount
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($estimate->items as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition">

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

                            <td class="p-2 text-right font-semibold text-indigo-600">
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

            <div class="w-60 sm:w-64 text-xs space-y-2">

                <div class="flex justify-between">
                    <span class="text-gray-600">Subtotal</span>
                    <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">
                        Vat ({{ $estimate->tax_percentage }}%)
                    </span>
                    <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
                </div>

                <div class="flex justify-between border-t pt-2 text-lg font-bold text-indigo-600">
                    <span>Total</span>
                    <span>₹ {{ number_format($estimate->total,2) }}</span>
                </div>

            </div>

        </div>


        {{-- ================= NOTES ================= --}}
        @if($estimate->notes)
        <div class="px-4 sm:px-6 pb-6 border-t border-gray-200">

            <h4 class="uppercase text-gray-500 font-semibold mb-2 tracking-wide text-[11px]">
                Notes
            </h4>

            <p class="text-xs text-gray-700 leading-relaxed">
                {{ $estimate->notes }}
            </p>

        </div>
        @endif

    </div>

</div>
