@extends('layouts.admin')

@section('content')


<div class="flex justify-end items-center gap-3 mb-6">

    {{-- TEMPLATE SELECTOR --}}
    <form action="{{ route('admin.estimates.changeTemplate', $estimate->id) }}" method="POST">
        @csrf
        <select name="template"
                onchange="this.form.submit()"
                class="border rounded px-3 py-2 text-sm bg-white">
            @foreach(['classic','minimal','blue','corporate','dark','modern','luxury','neon','glass'] as $tpl)
                <option value="{{ $tpl }}" {{ $template == $tpl ? 'selected' : '' }}>
                    {{ ucfirst($tpl) }}
                </option>
            @endforeach
        </select>
    </form>

   

    {{-- PDF DOWNLOAD --}}
<a href="{{ route('admin.estimates.pdf', $estimate->id) }}"
   class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700 transition">
    📄 Download PDF
</a>


    {{-- SEND MAIL --}}
    <form action="{{ route('admin.estimates.send', $estimate->id) }}" method="POST">
        @csrf
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition">
            📧 Send Mail
        </button>
    </form>

</div>


<div class="w-full {{ $theme['page_bg'] }} py-6 overflow-x-auto">

<div class="w-[900px] mx-auto {{ $theme['card_bg'] }} shadow-lg rounded-lg overflow-hidden">

{{-- HEADER --}}
<div class="flex justify-between items-start px-8 py-6 {{ $theme['header'] }}">

<div>
@if($setting->company_logo)
<img src="{{ asset('storage/'.$setting->company_logo) }}"
class="h-14 object-contain bg-white p-1 rounded">
@endif
</div>

<div class="text-right text-xs leading-5 max-w-sm {{ $theme['header_text'] }}">

<p class="font-semibold text-xl mb-2">
{{ $setting->company_name }}
</p>

 <div class="space-y-1">

            <div class="flex justify-end gap-4">
                <div class="flex items-center gap-1">
                    <i class="fa-solid fa-phone"></i>
                    {{ $setting->company_phone }}
                </div>

                <div class="flex items-center gap-1">
                    <i class="fa-solid fa-envelope"></i>
                    {{ $setting->company_email }}
                </div>
            </div>

            <div class="flex justify-end gap-4">
                @if($setting->company_website)
                <div class="flex items-center gap-1">
                    <i class="fa-solid fa-globe"></i>
                    {{ $setting->company_website }}
                </div>
                @endif

                <div class="flex items-center gap-1">
                    <i class="fa-solid fa-location-dot"></i>
                    {{ $setting->company_address }}
                </div>
            </div>

            @if($setting->trn_number)
            <div class="flex justify-end gap-1 font-medium mt-1">
                <i class="fa-solid fa-receipt"></i>
                TRN: {{ $setting->trn_number }}
            </div>
            @endif

        </div>

</div>
</div>


{{-- CLIENT --}}
<div class="grid grid-cols-2 gap-8 px-8 py-6 border-b text-xs">

<div>
<h3 class="uppercase font-semibold mb-2 {{ $theme['accent'] }}">
Bill To
</h3>

<p class="font-semibold">{{ $estimate->client->name }}</p>
<p>{{ $estimate->client->address }}</p>
<p>{{ $estimate->client->email }}</p>
<p>{{ $estimate->client->phone }}</p>

</div>

<div class="flex justify-end">

<div class="w-72 p-4 rounded {{ $theme['box'] }}">

<div class="flex justify-between mb-1">
<span>Estimate #</span>
<span>{{ $estimate->estimate_number }}</span>
</div>

<div class="flex justify-between mb-1">
<span>Issue Date</span>
<span>{{ $estimate->issue_date->format('d M Y') }}</span>
</div>

<div class="flex justify-between mb-1">
<span>Expiry</span>
<span>{{ $estimate->expiry_date ? $estimate->expiry_date->format('d M Y') : '-' }}</span>
</div>

<div class="border-t mt-3 pt-2 text-right">
<p>Grand Total</p>
<p class="text-lg font-semibold">
{{ $setting->currency_symbol }} {{ number_format($estimate->total,2) }}
</p>
</div>

</div>

</div>

</div>


{{-- TABLE --}}
<div class="px-8 py-6">

<table class="w-full text-xs border-collapse">

<thead class="{{ $theme['table_head'] }}">
<tr>
<th class="p-3 text-left">Services</th>
<th class="p-3 text-left">Description</th>
<th class="p-3 text-right">Qty</th>
<th class="p-3 text-right">Rate</th>
<th class="p-3 text-right">Amount</th>
</tr>
</thead>

<tbody>

@foreach($estimate->items as $item)

<tr class="border-b">

<td class="p-3 font-medium">{{ $item->title }}</td>

<td class="p-3 text-gray-600">
{{ $item->description }}
</td>

<td class="p-3 text-right">
{{ $item->quantity }}
</td>

<td class="p-3 text-right">
{{ $setting->currency_symbol }} {{ number_format($item->rate,2) }}
</td>

<td class="p-3 text-right font-semibold {{ $theme['amount'] }}">
{{ $setting->currency_symbol }} {{ number_format($item->amount,2) }}
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<div class="px-8 pb-6">

<div class="flex justify-between gap-8">

<div class="w-1/2 text-xs">

<h4 class="font-semibold mb-2">Notes</h4>

 <p class="mb-3">
                        {!! nl2br(e($estimate->notes)) !!}
                    </p>

                    @if($setting->payment_terms)
                        <p class="mb-2">
                            <span class="font-medium">Payment Terms:</span>
                            {{ $setting->payment_terms }}
                        </p>
                    @endif

                   @if(
    $setting->bank_name ||
    $setting->bank_account_number ||
    $setting->iban_number ||
    $setting->ifsc_code
)

<div class="mt-4">
    <p class="font-semibold mb-2">Bank Details</p>

    @if($setting->bank_beneficiary_name)
        <p>{{ $setting->bank_beneficiary_name }}</p>
    @endif

    @if($setting->bank_name)
        <p>{{ $setting->bank_name }}</p>
    @endif

    @if($setting->bank_account_number)
        <p>A/C: {{ $setting->bank_account_number }}</p>
    @endif

    {{-- 🇮🇳 India --}}
    @if($setting->ifsc_code)
        <p>IFSC: {{ $setting->ifsc_code }}</p>
    @endif

    {{-- 🌍 UAE / International --}}
    @if($setting->iban_number)
        <p>IBAN: {{ $setting->iban_number }}</p>
    @endif

    @if($setting->swift_code)
        <p>SWIFT: {{ $setting->swift_code }}</p>
    @endif

</div>

@endif

</div>

<div class="w-1/3 text-xs">

<div class="p-4 rounded {{ $theme['box'] }}">

<div class="flex justify-between py-1">
<span>Subtotal</span>
<span>{{ $setting->currency_symbol }} {{ number_format($estimate->subtotal,2) }}</span>
</div>
@foreach($estimate->taxes as $tax)
<div class="flex justify-between py-1">

    <span>
        {{ $tax->pivot->tax_name ?? $tax->name }} 
        ({{ $tax->pivot->tax_rate ?? $tax->rate }}%)
    </span>

    <span>
        {{ $setting->currency_symbol }} {{ number_format($tax->pivot->amount, 2) }}
    </span>

</div>
@endforeach


<div class="flex justify-between py-2 border-t font-semibold mt-2 {{ $theme['accent'] }}">
<span>Total</span>
<span>{{ $setting->currency_symbol }} {{ number_format($estimate->total,2) }}</span>
</div>

</div>

</div>

</div>

</div>

  <div class="px-8 pb-6">

    <div class="flex justify-end">

        <div class="text-center w-64">

            @if($setting->authorized_signature)
                <img src="{{ asset('storage/'.$setting->authorized_signature) }}"
                     class="h-20 mx-auto object-contain mb-2">
            @endif

            <div class="border-t pt-2 text-sm font-medium {{ $theme['footer_text'] }}">
                Authorized Signatory
            </div>

        </div>

    </div>

</div>


{{-- ================= FOOTER ================= --}}
@if($setting->company_website)

<div class="px-8 pb-8 border-t pt-4 text-center text-sm {{ $theme['footer_bg'] }} {{ $theme['footer_text'] }}">
    {{ $setting->company_website }}
</div>

@endif
</div>

@endsection