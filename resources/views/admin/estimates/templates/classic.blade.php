<div class="w-full overflow-x-auto">

    <div class="min-w-[100px] mx-auto bg-white rounded shadow overflow-hidden
                scale-[1] sm:scale-[1] md:scale-1 origin-top">

    {{-- ================= TOP HEADER ================= --}}
    <div class="flex justify-between items-center px-10 py-8 border-b">

        <div class="flex items-center gap-4">
            @if($setting->company_logo)
                <img src="{{ asset('storage/'.$setting->company_logo) }}" class="h-16">
            @endif

            <div>
                <h1 class="text-3xl font-semibold">
                    {{ $setting->company_name }}
                </h1>
                <p class="text-sm text-gray-500">
                    Estimate Document
                </p>
            </div>
        </div>

        <div class="text-right text-sm text-gray-600 leading-6">
            <p class="font-semibold text-gray-800">
                {{ $setting->company_name }}
            </p>
            <p>{{ $setting->company_address }}</p>
            <p>{{ $setting->company_email }}</p>
            <p>{{ $setting->company_phone }}</p>
        </div>
    </div>

    {{-- CLIENT + ESTIMATE --}}
    <div class="grid grid-cols-2 gap-10 px-10 py-8 border-b">

        <div>
            <h3 class="text-xs uppercase text-gray-500 font-semibold mb-3">
                Bill To
            </h3>

            <p class="font-semibold text-lg">
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
            <div class="w-72 p-6 rounded shadow-sm bg-gray-50">

                <div class="flex justify-between text-sm mb-2">
                    <span>Estimate #:</span>
                    <span>{{ $estimate->estimate_number }}</span>
                </div>

                <div class="flex justify-between text-sm mb-2">
                    <span>Issue Date:</span>
                    <span>{{ $estimate->issue_date }}</span>
                </div>

                <div class="flex justify-between text-sm mb-2">
                    <span>Expiry Date:</span>
                    <span>{{ $estimate->expiry_date ?? '-' }}</span>
                </div>

                <div class="border-t mt-4 pt-4 text-right">
                    <p class="text-xs">Grand Total</p>
                    <p class="text-xl font-bold">
                        ₹ {{ number_format($estimate->total,2) }}
                    </p>
                </div>

            </div>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="px-10 py-8">

        <table class="w-full text-sm border-collapse">

            <thead class="bg-purple-600 text-white">
                <tr>
                    <th class="p-4 text-left">Services</th>
                    <th class="p-4 text-right">Qty</th>
                    <th class="p-4 text-right">Rate</th>
                    <th class="p-4 text-right">Amount</th>
                </tr>
            </thead>

            <tbody>
                @foreach($estimate->items as $item)
                <tr class="border-b">
                    <td class="p-4">
                        <p class="font-medium">
                            {{ $item->title }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ $item->description }}
                        </p>
                    </td>

                    <td class="p-4 text-right">
                        {{ $item->quantity }}
                    </td>

                    <td class="p-4 text-right">
                        ₹ {{ number_format($item->rate,2) }}
                    </td>

                    <td class="p-4 text-right font-medium">
                        ₹ {{ number_format($item->amount,2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    {{-- SUMMARY --}}
    <div class="flex justify-end px-10 pb-10">

        <div class="w-80">

            <div class="flex justify-between py-2 text-sm">
                <span>Subtotal:</span>
                <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
            </div>

            <div class="flex justify-between py-2 text-sm">
                <span>Tax ({{ $estimate->tax_percentage }}%):</span>
                <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
            </div>

            <div class="flex justify-between py-3 border-t font-bold text-lg">
                <span>Total:</span>
                <span>₹ {{ number_format($estimate->total,2) }}</span>
            </div>

        </div>

    </div>

    {{-- NOTES --}}
    @if($estimate->notes)
    <div class="px-10 pb-10">

        <div class="bg-gray-50 border rounded p-6">
            <h4 class="text-sm uppercase text-gray-500 font-semibold mb-3">
                Notes
            </h4>

            <p class="text-sm text-gray-700 leading-relaxed">
                {{ $estimate->notes }}
            </p>
        </div>

    </div>
    @endif

    </div>

</div>
