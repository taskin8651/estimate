<div class="max-w-6xl mx-auto bg-white rounded shadow overflow-hidden">

    {{-- ================= TOP HEADER ================= --}}
    <div class="bg-blue-600 text-white px-10 py-8 flex justify-between items-center">

        <div class="flex items-center gap-4">
            @if($setting->company_logo)
                <img src="{{ asset('storage/'.$setting->company_logo) }}"
                     class="h-14 bg-white p-1 rounded">
            @endif

            <div>
                <h1 class="text-2xl font-semibold">
                    {{ $setting->company_name }}
                </h1>
                <p class="text-sm text-blue-100">
                    Estimate Document
                </p>
            </div>
        </div>

        <div class="text-right text-sm">
             <p class="font-semibold text-gray-800">
                {{ $setting->company_name }}
            </p>
            <p>{{ $setting->company_address }}</p>
            <p>{{ $setting->company_email }}</p>
            <p>{{ $setting->company_phone }}</p>
        </div>
    </div>


    {{-- ================= CLIENT + ESTIMATE ================= --}}
    <div class="grid grid-cols-2 gap-10 px-10 py-8 border-b border-gray-200">

        {{-- CLIENT --}}
        <div>
            <h3 class="text-xs uppercase text-blue-600 font-semibold mb-3">
                Bill To
            </h3>

            <p class="font-medium text-gray-800">
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
            <div class="w-72 p-6 rounded border border-blue-200 bg-blue-50">

                <div class="flex justify-between text-sm mb-2">
                    <span class="text-blue-500">Estimate #</span>
                    <span>{{ $estimate->estimate_number }}</span>
                </div>

                <div class="flex justify-between text-sm mb-2">
                    <span class="text-blue-500">Issue Date</span>
                    <span>{{ $estimate->issue_date }}</span>
                </div>

                <div class="flex justify-between text-sm mb-2">
                    <span class="text-blue-500">Expiry Date</span>
                    <span>{{ $estimate->expiry_date ?? '-' }}</span>
                </div>

                <div class="border-t border-blue-200 mt-4 pt-3 text-right">
                    <p class="text-xs text-blue-500">Grand Total</p>
                    <p class="text-lg font-semibold text-blue-700">
                        ₹ {{ number_format($estimate->total,2) }}
                    </p>
                </div>

            </div>
        </div>

    </div>


    {{-- ================= TABLE ================= --}}
    <div class="px-10 py-8">

        <table class="w-full text-sm border-collapse">

            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 text-left">Services</th>
                    <th class="py-3 text-right">Qty</th>
                    <th class="py-3 text-right">Rate</th>
                    <th class="py-3 text-right">Amount</th>
                </tr>
            </thead>

            <tbody>
                @foreach($estimate->items as $item)
                <tr class="border-b border-gray-200">
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

                    <td class="py-4 text-right font-medium text-blue-600">
                        ₹ {{ number_format($item->amount,2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>


    {{-- ================= SUMMARY ================= --}}
    <div class="flex justify-end px-10 pb-10">

        <div class="w-72 space-y-2">

            <div class="flex justify-between text-sm">
                <span class="text-gray-600">Subtotal</span>
                <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
            </div>

            <div class="flex justify-between text-sm">
                <span class="text-gray-600">
                    Tax ({{ $estimate->tax_percentage }}%)
                </span>
                <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
            </div>

            <div class="flex justify-between border-t border-gray-200 pt-3 text-lg font-semibold text-blue-700">
                <span>Total</span>
                <span>₹ {{ number_format($estimate->total,2) }}</span>
            </div>

        </div>

    </div>


    {{-- ================= NOTES ================= --}}
    @if($estimate->notes)
    <div class="px-10 pb-10 border-t border-gray-200">

        <h4 class="text-xs uppercase text-blue-600 font-semibold mb-3">
            Notes
        </h4>

        <p class="text-sm text-gray-600">
            {{ $estimate->notes }}
        </p>

    </div>
    @endif

</div>
