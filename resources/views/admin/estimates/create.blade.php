@extends('layouts.admin')

@section('content')

<div class="w-full px-3 sm:px-6 py-6">

    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow p-4 sm:p-6">

        <h2 class="text-xl sm:text-2xl font-semibold mb-6">
            Create Estimate
        </h2>

        <form action="{{ route('admin.estimates.store') }}" method="POST">
            @csrf

            {{-- CLIENT + DATES --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

                <div>
                    <label class="block text-sm font-medium mb-1">Client</label>
                    <select name="client_id" class="w-full border rounded px-3 py-2 text-sm">
                        <option value="">Select Client</option>
                        @foreach($clients as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Issue Date</label>
                    <input type="date" name="issue_date"
                           class="w-full border rounded px-3 py-2 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Expiry Date</label>
                    <input type="date" name="expiry_date"
                           class="w-full border rounded px-3 py-2 text-sm">
                </div>

            </div>

            {{-- ITEMS --}}
        <div class="mb-6">

<div class="overflow-x-auto">

<table class="w-full border text-sm" id="items-table">

<thead class="bg-gray-100">
<tr>
<th class="p-2 border w-40">Title</th>
<th class="p-2 border">Description</th>
<th class="p-2 border w-24">Qty</th>
<th class="p-2 border w-32">Rate</th>
<th class="p-2 border w-32">Amount</th>
<th class="p-2 border w-16">Action</th>
</tr>
</thead>

<tbody>

<tr>

<td class="border p-2">
<input
type="text"
name="items[0][title]"
placeholder="Item title"
class="w-full border rounded px-2 py-1 text-sm">
</td>

<td class="border p-2">
<input
type="text"
name="items[0][description]"
placeholder="Item description"
class="w-full border rounded px-2 py-1 text-sm">
</td>

<td class="border p-2">
<input
type="number"
step="0.01"
name="items[0][quantity]"
placeholder="0"
class="w-full border rounded px-2 py-1 text-sm qty">
</td>

<td class="border p-2">
<input
type="number"
step="0.01"
name="items[0][rate]"
placeholder="0.00"
class="w-full border rounded px-2 py-1 text-sm rate">
</td>

<td class="border p-2">
<input
type="text"
readonly
class="w-full border rounded px-2 py-1 text-sm amount bg-gray-100">
</td>

<td class="border p-2 text-center">

<button
type="button"
class="text-red-500 hover:text-red-700 remove-row">
✕
</button>

</td>

</tr>

</tbody>

</table>

</div>

<button
type="button"
id="add-row"
class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">

+ Add Item

</button>

</div>

            {{-- TAX & TOTAL --}}
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    {{-- Taxes --}}
    <div class="bg-white border rounded-lg p-4 shadow-sm">

        <h3 class="text-sm font-semibold text-gray-700 mb-3">
            Taxes
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">

            @foreach($taxes as $tax)

            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">

                <input type="checkbox"
                       name="taxes[]"
                       value="{{ $tax->id }}"
                       data-rate="{{ $tax->rate }}"
                       class="tax-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">

                <span>
                    {{ $tax->name }}
                    <span class="text-gray-500">({{ $tax->rate }}%)</span>
                </span>

            </label>

            @endforeach

        </div>

    </div>


    {{-- Totals --}}
    <div class="bg-white border rounded-lg p-4 shadow-sm">

        <h3 class="text-sm font-semibold text-gray-700 mb-4">
            Summary
        </h3>

        <div class="space-y-3">

            {{-- Subtotal --}}
            <div>
                <label class="block text-xs text-gray-500 mb-1">
                    Subtotal
                </label>

                <input type="text"
                       readonly
                       id="subtotal"
                       class="w-full border rounded px-3 py-2 bg-gray-100 text-sm">
            </div>


            {{-- Tax Amount --}}
            <div>
                <label class="block text-xs text-gray-500 mb-1">
                    Tax Amount
                </label>

                <input type="text"
                       readonly
                       id="tax_total"
                       class="w-full border rounded px-3 py-2 bg-gray-100 text-sm">
            </div>


            {{-- Total --}}
            <div>
                <label class="block text-xs text-gray-500 mb-1 font-semibold">
                    Grand Total
                </label>

                <input type="text"
                       readonly
                       id="total"
                       class="w-full border rounded px-3 py-2 bg-gray-100 font-semibold text-sm">
            </div>

        </div>

    </div>

</div>

            {{-- NOTES --}}
            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">Notes</label>
                <textarea name="notes"
                          rows="4"
                          class="w-full border rounded px-3 py-2 text-sm"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded text-sm">
                    Save Estimate
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
@section('scripts')
<script>

let rowIndex = 1;

const addBtn = document.getElementById('add-row');
const desktopTableBody = document.querySelector('#items-table tbody');
const mobileContainer = document.getElementById('mobile-items');


// ===== ADD ROW =====
addBtn.addEventListener('click', function () {

    if (desktopTableBody) {
        desktopTableBody.insertAdjacentHTML('beforeend', `
        <tr>
            <td class="border p-2">
                <input type="text" name="items[${rowIndex}][title]" class="w-full border rounded px-2 py-1 text-sm">
            </td>
            <td class="border p-2">
                <input type="text" name="items[${rowIndex}][description]" class="w-full border rounded px-2 py-1 text-sm">
            </td>
            <td class="border p-2">
                <input type="number" step="0.01" name="items[${rowIndex}][quantity]" class="w-full border rounded px-2 py-1 text-sm qty">
            </td>
            <td class="border p-2">
                <input type="number" step="0.01" name="items[${rowIndex}][rate]" class="w-full border rounded px-2 py-1 text-sm rate">
            </td>
            <td class="border p-2">
                <input type="text" readonly class="w-full border rounded px-2 py-1 text-sm amount bg-gray-100">
            </td>
            <td class="border p-2 text-center">
                <button type="button" class="text-red-500 remove-row">X</button>
            </td>
        </tr>
        `);
    }

    if (mobileContainer) {
        mobileContainer.insertAdjacentHTML('beforeend', `
        <div class="border rounded-lg p-3 shadow-sm mobile-row">

            <input type="text" name="items[${rowIndex}][title]" placeholder="Title"
                   class="w-full border rounded px-2 py-1 text-sm">

            <input type="text" name="items[${rowIndex}][description]" placeholder="Description"
                   class="w-full border rounded px-2 py-1 text-sm">

            <div class="grid grid-cols-2 gap-2">

                <input type="number" step="0.01" name="items[${rowIndex}][quantity]"
                       placeholder="Qty"
                       class="border rounded px-2 py-1 text-sm qty">

                <input type="number" step="0.01" name="items[${rowIndex}][rate]"
                       placeholder="Rate"
                       class="border rounded px-2 py-1 text-sm rate">

            </div>

            <input type="text" readonly
                   placeholder="Amount"
                   class="w-full border rounded px-2 py-1 text-sm amount bg-gray-100">

            <button type="button"
                    class="text-red-500 text-sm remove-row">
                Remove
            </button>

        </div>
        `);
    }

    rowIndex++;
});


// ===== INPUT CHANGE =====
document.addEventListener('input', function(e) {

    if (
        e.target.classList.contains('qty') ||
        e.target.classList.contains('rate')
    ) {
        calculateTotals();
    }
});


// ===== TAX CHECKBOX CHANGE =====
document.querySelectorAll('.tax-checkbox').forEach(function(cb){

    cb.addEventListener('change', calculateTotals);

});


// ===== REMOVE ROW =====
document.addEventListener('click', function(e){

    if(e.target.classList.contains('remove-row')){

        const row = e.target.closest('tr') || e.target.closest('.mobile-row');

        if (row) row.remove();

        calculateTotals();
    }
});


// ===== CALCULATION FUNCTION =====
function calculateTotals() {

    let subtotal = 0;

    document.querySelectorAll('.qty').forEach(function(qtyInput){

        const container = qtyInput.closest('tr') || qtyInput.closest('.mobile-row');

        if (!container) return;

        const qty = parseFloat(container.querySelector('.qty')?.value) || 0;
        const rate = parseFloat(container.querySelector('.rate')?.value) || 0;

        const amount = qty * rate;

        const amountField = container.querySelector('.amount');

        if (amountField) {
            amountField.value = amount.toFixed(2);
        }

        subtotal += amount;
    });


    // SUBTOTAL
    const subtotalField = document.getElementById('subtotal');
    subtotalField.value = subtotal.toFixed(2);


    // TAX CALCULATION
    let taxTotal = 0;

    document.querySelectorAll('.tax-checkbox:checked').forEach(function(tax){

        const rate = parseFloat(tax.dataset.rate) || 0;

        taxTotal += (subtotal * rate) / 100;

    });


    const taxField = document.getElementById('tax_total');

    if (taxField) {
        taxField.value = taxTotal.toFixed(2);
    }


    // GRAND TOTAL
    const totalField = document.getElementById('total');

    if (totalField) {
        totalField.value = (subtotal + taxTotal).toFixed(2);
    }

}

</script>
@endsection