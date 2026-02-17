<div class="w-full bg-black py-4 px-3">

    <div class="w-full max-w-4xl mx-auto 
                bg-gray-900 
                border border-cyan-500/60 
                rounded-lg 
                shadow-[0_0_25px_rgba(0,255,255,0.2)] 
                overflow-hidden text-gray-200">


        {{-- ================= TOP HEADER ================= --}}
        <div class="px-6 py-6 border-b border-cyan-500/40 
                    flex justify-between items-center">

            <div class="flex items-center gap-3">
                @if($setting->company_logo)
                    <img src="{{ asset('storage/'.$setting->company_logo) }}"
                         class="h-12 bg-white p-1 rounded">
                @endif

                <div class="text-sm hidden sm:block">
                    <h1 class="text-lg font-bold text-cyan-400 uppercase tracking-wide">
                        {{ $setting->company_name }}
                    </h1>
                    <p class="text-xs text-gray-400">
                        {{ $setting->company_address }}
                    </p>
                    <p class="text-xs text-gray-400">
                        {{ $setting->company_email }} | {{ $setting->company_phone }}
                    </p>
                </div>
            </div>

            <div class="text-right text-xs text-gray-400 leading-5">
                <p class="font-medium text-cyan-300">
                    {{ $setting->company_name }}
                </p>
                <p>{{ $setting->company_address }}</p>
                <p>{{ $setting->company_email }}</p>
                <p>{{ $setting->company_phone }}</p>
            </div>

        </div>


        {{-- ================= CLIENT + ESTIMATE ================= --}}
        <div class="grid grid-cols-2 gap-6 
                    px-4 sm:px-6 py-5 
                    border-b border-cyan-500/40 
                    text-[11px]">

            {{-- CLIENT --}}
            <div>
                <h3 class="uppercase text-cyan-400 
                           font-semibold mb-2 tracking-wide text-[11px]">
                    Bill To
                </h3>

                <p class="font-semibold text-white">
                    {{ $estimate->client->name }}
                </p>

                <p class="text-xs text-gray-400">
                    {{ $estimate->client->address }}
                </p>

                <p class="text-xs text-gray-400">
                    {{ $estimate->client->email }}
                </p>

                <p class="text-xs text-gray-400">
                    {{ $estimate->client->phone }}
                </p>
            </div>


            {{-- ESTIMATE BOX --}}
            <div class="flex justify-end">
                <div class="w-60 sm:w-64 p-4 
                            border border-cyan-500/60 
                            bg-gray-800/60 
                            rounded 
                            text-[11px]">

                    <div class="flex justify-between mb-1">
                        <span class="text-gray-400">Estimate #</span>
                        <span class="font-medium text-cyan-300">
                            {{ $estimate->estimate_number }}
                        </span>
                    </div>

                    <div class="flex justify-between mb-1">
                        <span class="text-gray-400">Issue Date</span>
                        <span>{{ $estimate->issue_date }}</span>
                    </div>

                    <div class="flex justify-between mb-1">
                        <span class="text-gray-400">Expiry Date</span>
                        <span>{{ $estimate->expiry_date ?? '-' }}</span>
                    </div>

                    <div class="border-t border-cyan-500/40 mt-3 pt-2 text-right">
                        <p class="text-[10px] text-gray-500">Grand Total</p>
                        <p class="text-base font-bold text-cyan-400">
                            ₹ {{ number_format($estimate->total,2) }}
                        </p>
                    </div>

                </div>
            </div>

        </div>


        {{-- ================= TABLE ================= --}}
        <div class="px-4 sm:px-6 py-5">

            <div class="overflow-x-auto">
                <table class="w-full text-xs 
                              border border-cyan-500/60 
                              border-collapse">

                    <thead class="bg-cyan-500 text-black text-[12px]">
                        <tr>
                            <th class="p-2 border border-cyan-500/60 text-left font-semibold">
                                Services
                            </th>
                            <th class="p-2 border border-cyan-500/60 text-right font-semibold">
                                Qty
                            </th>
                            <th class="p-2 border border-cyan-500/60 text-right font-semibold">
                                Rate
                            </th>
                            <th class="p-2 border border-cyan-500/60 text-right font-semibold">
                                Amount
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($estimate->items as $item)
                        <tr class="border-t border-cyan-500/30 hover:bg-gray-800 transition">

                            <td class="p-2 border border-cyan-500/30">
                                <p class="font-medium text-white">
                                    {{ $item->title }}
                                </p>
                                <p class="text-[10px] text-gray-500">
                                    {{ $item->description }}
                                </p>
                            </td>

                            <td class="p-2 border border-cyan-500/30 text-right">
                                {{ $item->quantity }}
                            </td>

                            <td class="p-2 border border-cyan-500/30 text-right">
                                ₹ {{ number_format($item->rate,2) }}
                            </td>

                            <td class="p-2 border border-cyan-500/30 text-right font-semibold text-cyan-400">
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
                        border border-cyan-500/60 
                        p-4 bg-gray-800/60 
                        rounded text-xs">

                <div class="flex justify-between py-1">
                    <span class="text-gray-400">Subtotal</span>
                    <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
                </div>

                <div class="flex justify-between py-1">
                    <span class="text-gray-400">
                        Vat ({{ $estimate->tax_percentage }}%)
                    </span>
                    <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
                </div>

                <div class="flex justify-between py-2 
                            border-t border-cyan-500/40 
                            font-bold text-sm text-cyan-400">
                    <span>Total</span>
                    <span>₹ {{ number_format($estimate->total,2) }}</span>
                </div>

            </div>

        </div>


        {{-- ================= NOTES ================= --}}
        @if($estimate->notes)
        <div class="px-4 sm:px-6 pb-6 border-t border-cyan-500/40">

            <h4 class="uppercase text-cyan-400 
                       font-semibold mb-2 tracking-wide text-[11px]">
                Notes
            </h4>

            <p class="text-xs text-gray-400">
                {{ $estimate->notes }}
            </p>

        </div>
        @endif

    </div>

</div>
