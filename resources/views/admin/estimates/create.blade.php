@extends('layouts.admin')

@section('content')

<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-semibold mb-6">Create Estimate</h2>

    <form action="{{ route('admin.estimates.store') }}" method="POST">
        @csrf

        {{-- Client & Dates --}}
        <div class="grid grid-cols-3 gap-4 mb-6">

            <div>
                <label class="block mb-1 font-medium">Client</label>
                <select name="client_id" class="w-full border rounded px-3 py-2">
                    <option value="">Select Client</option>
                    @foreach($clients as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Issue Date</label>
                <input type="date" name="issue_date"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Expiry Date</label>
                <input type="date" name="expiry_date"
                       class="w-full border rounded px-3 py-2">
            </div>

        </div>

        {{-- Items Table --}}
        <div class="mb-6">
            <table class="w-full border text-sm" id="items-table">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">Title</th>
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
                            <input type="text" name="items[0][title]" class="w-full border rounded px-2 py-1">
                        </td>
                        <td class="border p-2">
                            <input type="text" name="items[0][description]" class="w-full border rounded px-2 py-1">
                        </td>
                        <td class="border p-2">
                            <input type="number" step="0.01" name="items[0][quantity]"
                                   class="w-full border rounded px-2 py-1 qty">
                        </td>
                        <td class="border p-2">
                            <input type="number" step="0.01" name="items[0][rate]"
                                   class="w-full border rounded px-2 py-1 rate">
                        </td>
                        <td class="border p-2">
                            <input type="text" readonly
                                   class="w-full border rounded px-2 py-1 amount">
                        </td>
                        <td class="border p-2 text-center">
                            <button type="button" class="text-red-500 remove-row">X</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button"
                    class="mt-3 bg-blue-500 text-white px-4 py-2 rounded"
                    id="add-row">
                + Add Item
            </button>
        </div>

        {{-- Tax & Summary --}}
        <div class="grid grid-cols-3 gap-4 mb-6">

            <div>
                <label class="block mb-1 font-medium">Tax %</label>
                <input type="number" step="0.01" name="tax_percentage"
                       id="tax"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Subtotal</label>
                <input type="text" readonly id="subtotal"
                       class="w-full border rounded px-3 py-2 bg-gray-100">
            </div>

            <div>
                <label class="block mb-1 font-medium">Total</label>
                <input type="text" readonly id="total"
                       class="w-full border rounded px-3 py-2 bg-gray-100">
            </div>

        </div>

        <div class="mb-6">
            <label class="block mb-1 font-medium">Notes</label>
            <textarea name="notes"
                      class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <button type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded">
            Save Estimate
        </button>

    </form>
</div>

@endsection

@section('scripts')
<script>

let rowIndex = 1;

document.getElementById('add-row').addEventListener('click', function () {
    const table = document.querySelector('#items-table tbody');
    const row = `
        <tr>
            <td class="border p-2">
                <input type="text" name="items[${rowIndex}][title]" class="w-full border rounded px-2 py-1">
            </td>
            <td class="border p-2">
                <input type="text" name="items[${rowIndex}][description]" class="w-full border rounded px-2 py-1">
            </td>
            <td class="border p-2">
                <input type="number" step="0.01" name="items[${rowIndex}][quantity]" class="w-full border rounded px-2 py-1 qty">
            </td>
            <td class="border p-2">
                <input type="number" step="0.01" name="items[${rowIndex}][rate]" class="w-full border rounded px-2 py-1 rate">
            </td>
            <td class="border p-2">
                <input type="text" readonly class="w-full border rounded px-2 py-1 amount">
            </td>
            <td class="border p-2 text-center">
                <button type="button" class="text-red-500 remove-row">X</button>
            </td>
        </tr>
    `;
    table.insertAdjacentHTML('beforeend', row);
    rowIndex++;
});

document.addEventListener('input', function(e) {

    if (e.target.classList.contains('qty') ||
        e.target.classList.contains('rate') ||
        e.target.id === 'tax') {

        calculateTotals();
    }
});

document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove-row')){
        e.target.closest('tr').remove();
        calculateTotals();
    }
});

function calculateTotals() {

    let subtotal = 0;

    document.querySelectorAll('#items-table tbody tr').forEach(function(row){

        const qty = parseFloat(row.querySelector('.qty')?.value) || 0;
        const rate = parseFloat(row.querySelector('.rate')?.value) || 0;
        const amount = qty * rate;

        row.querySelector('.amount').value = amount.toFixed(2);
        subtotal += amount;
    });

    document.getElementById('subtotal').value = subtotal.toFixed(2);

    const taxPercent = parseFloat(document.getElementById('tax').value) || 0;
    const taxAmount = (subtotal * taxPercent) / 100;

    document.getElementById('total').value = (subtotal + taxAmount).toFixed(2);
}

</script>
@endsection
