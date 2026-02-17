<div class="w-full bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 py-4 px-3">

    <div class="w-full max-w-4xl mx-auto 
                bg-white/40 backdrop-blur-2xl 
                border border-white/50 
                rounded-lg shadow-xl overflow-hidden">


        {{-- ================= TOP HEADER ================= --}}
        <div class="px-6 py-6 border-b border-white/40 flex justify-between items-center">

            <div class="flex items-center gap-3">
                @if($setting->company_logo)
                    <img src="{{ asset('storage/'.$setting->company_logo) }}"
                         class="h-12 bg-white/60 p-1 rounded shadow">
                @endif

                <div class="text-sm hidden sm:block">
                    <h1 class="text-lg font-bold text-gray-900 uppercase tracking-wide">
                        {{ $setting->company_name }}
                    </h1>
                    <p class="text-xs text-gray-700">
                        {{ $setting->company_address }}
                    </p>
                    <p class="text-xs text-gray-700">
                        {{ $setting->company_email }} | {{ $setting->company_phone }}
                    </p>
                </div>
            </div>

            <div class="text-right text-xs text-gray-800 leading-5">
                <p class="font-medium">
                    {{ $setting->company_name }}
                </p>
                <p>{{ $setting->company_address }}</p>
                <p>{{ $setting->company_email }}</p>
                <p>{{ $setting->company_phone }}</p>
            </div>

        </div>


        {{-- ================= CLIENT + ESTIMATE ================= --}}
        <div class="grid grid-cols-2 gap-6 px-4 sm:px-6 py-5 border-b border-white/40 text-[11px]">

            {{-- CLIENT --}}
            <div>
                <h3 class="uppercase text-gray-700 font-semibold mb-2 tracking-wide text-[11px]">
                    Bill To
                </h3>

                <p class="font-semibold text-gray-900">
                    {{ $estimate->client->name }}
                </p>

                <p class="text-xs text-gray-700">
                    {{ $estimate->client->address }}
                </p>

                <p class="text-xs text-gray-700">
                    {{ $estimate->client->email }}
                </p>

                <p class="text-xs text-gray-700">
                    {{ $estimate->client->phone }}
                </p>
            </div>


            {{-- ESTIMATE BOX --}}
            <div class="flex justify-end">
                <div class="w-60 sm:w-64 p-4 
                            bg-white/50 backdrop-blur-xl
                            border border-white/50 
                            rounded-lg text-[11px] shadow">

                    <div class="flex justify-between mb-1">
                        <span class="text-gray-700">Estimate #</span>
                        <span class="font-medium">{{ $estimate->estimate_number }}</span>
                    </div>

                    <div class="flex justify-between mb-1">
                        <span class="text-gray-700">Issue Date</span>
                        <span>{{ $estimate->issue_date }}</span>
                    </div>

                    <div class="flex justify-between mb-1">
                        <span class="text-gray-700">Expiry Date</span>
                        <span>{{ $estimate->expiry_date ?? '-' }}</span>
                    </div>

                    <div class="border-t border-white/40 mt-3 pt-2 text-right">
                        <p class="text-[10px] text-gray-700">Grand Total</p>
                        <p class="text-base font-bold text-indigo-600">
                            ₹ {{ number_format($estimate->total,2) }}
                        </p>
                    </div>

                </div>
            </div>

        </div>


        {{-- ================= TABLE ================= --}}
        <div class="px-4 sm:px-6 py-5">

            <div class="overflow-x-auto">
                <table class="w-full text-xs border border-white/50 border-collapse bg-white/40 backdrop-blur-xl">

                    <thead class="bg-white/60 text-[12px]">
                        <tr>
                            <th class="p-2 border border-white/40 text-left font-semibold text-gray-800">
                                Services
                            </th>
                            <th class="p-2 border border-white/40 text-right font-semibold text-gray-800">
                                Qty
                            </th>
                            <th class="p-2 border border-white/40 text-right font-semibold text-gray-800">
                                Rate
                            </th>
                            <th class="p-2 border border-white/40 text-right font-semibold text-gray-800">
                                Amount
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($estimate->items as $item)
                        <tr>
                            <td class="p-2 border border-white/40">
                                <p class="font-medium text-gray-900">
                                    {{ $item->title }}
                                </p>
                                <p class="text-[10px] text-gray-700">
                                    {{ $item->description }}
                                </p>
                            </td>

                            <td class="p-2 border border-white/40 text-right">
                                {{ $item->quantity }}
                            </td>

                            <td class="p-2 border border-white/40 text-right">
                                ₹ {{ number_format($item->rate,2) }}
                            </td>

                            <td class="p-2 border border-white/40 text-right font-semibold text-indigo-600">
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
                        bg-white/50 backdrop-blur-xl
                        border border-white/50 
                        p-4 text-xs rounded-lg shadow">

                <div class="flex justify-between py-1">
                    <span class="text-gray-700">Subtotal</span>
                    <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
                </div>

                <div class="flex justify-between py-1">
                    <span class="text-gray-700">
                        Vat ({{ $estimate->tax_percentage }}%)
                    </span>
                    <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
                </div>

                <div class="flex justify-between py-2 border-t border-white/40 font-bold text-sm text-indigo-600">
                    <span>Total</span>
                    <span>₹ {{ number_format($estimate->total,2) }}</span>
                </div>

            </div>

        </div>


        {{-- ================= NOTES ================= --}}
        @if($estimate->notes)
        <div class="px-4 sm:px-6 pb-6 border-t border-white/40">

            <h4 class="uppercase text-gray-700 font-semibold mb-2 tracking-wide text-[11px]">
                Notes
            </h4>

            <p class="text-xs text-gray-800">
                {{ $estimate->notes }}
            </p>

        </div>
        @endif

    </div>

</div>
