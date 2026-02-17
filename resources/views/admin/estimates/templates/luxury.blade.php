<div class="w-full bg-gradient-to-br from-yellow-50 via-white to-yellow-100 py-4 px-3">

    <div class="w-full max-w-4xl mx-auto 
                bg-white border border-yellow-300 
                rounded-lg shadow-lg overflow-hidden">


        {{-- ================= HEADER ================= --}}
        <div class="px-6 py-6 border-b border-yellow-300 
                    flex justify-between items-center
                    bg-gradient-to-r from-yellow-50 to-white">

            <div class="flex items-center gap-3">
                @if($setting->company_logo)
                    <img src="{{ asset('storage/'.$setting->company_logo) }}"
                         class="h-12">
                @endif

                <div class="text-sm hidden sm:block">
                    <h1 class="text-lg font-bold text-gray-800 tracking-wide uppercase">
                        {{ $setting->company_name }}
                    </h1>
                    <p class="text-xs text-yellow-700 uppercase tracking-widest">
                        Premium Estimate
                    </p>
                </div>
            </div>

            <div class="text-right text-xs text-gray-700 leading-5">
                <p class="font-semibold text-gray-800">
                    {{ $setting->company_name }}
                </p>
                <p>{{ $setting->company_address }}</p>
                <p>{{ $setting->company_email }}</p>
                <p>{{ $setting->company_phone }}</p>
            </div>

        </div>


        {{-- ================= CLIENT SECTION ================= --}}
        <div class="grid grid-cols-2 gap-6 px-4 sm:px-6 py-6 
                    border-b border-yellow-300 text-[11px]">

            <div>
                <h3 class="uppercase text-yellow-700 font-semibold mb-2 tracking-widest text-[11px]">
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
                <div class="w-60 sm:w-64 p-4 
                            border border-yellow-400 
                            rounded-lg bg-yellow-50 text-[11px]">

                    <div class="flex justify-between mb-1">
                        <span class="text-gray-600">Issue Date</span>
                        <span>{{ $estimate->issue_date }}</span>
                    </div>

                    <div class="flex justify-between mb-1">
                        <span class="text-gray-600">Expiry Date</span>
                        <span>{{ $estimate->expiry_date ?? '-' }}</span>
                    </div>

                    <div class="border-t border-yellow-400 mt-3 pt-2 text-right">
                        <p class="text-[10px] uppercase tracking-wide text-gray-600">
                            Grand Total
                        </p>
                        <p class="text-xl font-bold text-yellow-700">
                            ₹ {{ number_format($estimate->total,2) }}
                        </p>
                    </div>

                </div>
            </div>

        </div>


        {{-- ================= TABLE ================= --}}
        <div class="px-4 sm:px-6 py-6">

            <div class="overflow-x-auto">
                <table class="w-full text-xs border border-yellow-300 border-collapse">

                    <thead class="bg-yellow-100 text-yellow-900 text-[12px]">
                        <tr>
                            <th class="p-2 border border-yellow-300 text-left font-semibold">
                                Services
                            </th>
                            <th class="p-2 border border-yellow-300 text-right font-semibold">
                                Qty
                            </th>
                            <th class="p-2 border border-yellow-300 text-right font-semibold">
                                Rate
                            </th>
                            <th class="p-2 border border-yellow-300 text-right font-semibold">
                                Amount
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($estimate->items as $item)
                        <tr class="border-t border-yellow-200 hover:bg-yellow-50 transition">
                            <td class="p-2 border border-yellow-200">
                                <p class="font-medium text-gray-800">
                                    {{ $item->title }}
                                </p>
                                <p class="text-[10px] text-gray-500">
                                    {{ $item->description }}
                                </p>
                            </td>

                            <td class="p-2 border border-yellow-200 text-right">
                                {{ $item->quantity }}
                            </td>

                            <td class="p-2 border border-yellow-200 text-right">
                                ₹ {{ number_format($item->rate,2) }}
                            </td>

                            <td class="p-2 border border-yellow-200 text-right font-semibold text-yellow-700">
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

            <div class="w-60 sm:w-64 
                        border border-yellow-300 
                        p-4 rounded-lg bg-yellow-50 text-xs">

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

                <div class="flex justify-between py-2 border-t border-yellow-400 font-bold text-base text-yellow-700">
                    <span>Total</span>
                    <span>₹ {{ number_format($estimate->total,2) }}</span>
                </div>

            </div>

        </div>


        {{-- ================= NOTES ================= --}}
        @if($estimate->notes)
        <div class="px-4 sm:px-6 pb-6 border-t border-yellow-300">

            <h4 class="uppercase text-yellow-700 font-semibold mb-2 tracking-widest text-[11px]">
                Notes
            </h4>

            <p class="text-xs text-gray-700 leading-relaxed">
                {{ $estimate->notes }}
            </p>

        </div>
        @endif

    </div>

</div>
