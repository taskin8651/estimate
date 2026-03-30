@extends('layouts.admin')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-8">

    <h2 class="text-2xl font-bold mb-6">Company Settings</h2>

    @if(session('success'))
        <div class="mb-6 bg-green-100 text-green-700 p-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- 🔹 Company Info Card -->
        <div class="bg-white shadow rounded-xl p-6">
            <h3 class="font-semibold text-lg mb-4 border-b pb-2">Company Info</h3>

            <div class="grid md:grid-cols-2 gap-4">

                <input type="text" name="company_name" value="{{ old('company_name', $setting->company_name) }}"
                    placeholder="Company Name"
                    class="input">

                <input type="email" name="company_email" value="{{ old('company_email', $setting->company_email) }}"
                    placeholder="Email"
                    class="input">

                <input type="text" name="company_phone" value="{{ old('company_phone', $setting->company_phone) }}"
                    placeholder="Phone"
                    class="input">

                <input type="text" name="company_website" value="{{ old('company_website', $setting->company_website) }}"
                    placeholder="Website"
                    class="input">
            </div>

            <textarea name="company_address" rows="3"
                class="input mt-4"
                placeholder="Address">{{ old('company_address', $setting->company_address) }}</textarea>
        </div>


        <!-- 🔹 Location Card -->
        <div class="bg-white shadow rounded-xl p-6">
            <h3 class="font-semibold text-lg mb-4 border-b pb-2">Location</h3>

            <div class="grid md:grid-cols-2 gap-4">

                <input type="text" name="company_city" value="{{ old('company_city', $setting->company_city) }}"
                    placeholder="City" class="input">

                <input type="text" name="company_state" value="{{ old('company_state', $setting->company_state) }}"
                    placeholder="State" class="input">

                <input type="text" name="company_country" value="{{ old('company_country', $setting->company_country) }}"
                    placeholder="Country" class="input">

                <input type="text" name="company_zip" value="{{ old('company_zip', $setting->company_zip) }}"
                    placeholder="ZIP Code" class="input">
            </div>
        </div>


        <!-- 🔹 Bank Details Card -->
        <div class="bg-white shadow rounded-xl p-6">
            <h3 class="font-semibold text-lg mb-4 border-b pb-2">Bank Details</h3>

            <div class="grid md:grid-cols-2 gap-4">

                <input type="text" name="bank_beneficiary_name" value="{{ old('bank_beneficiary_name', $setting->bank_beneficiary_name) }}"
                    placeholder="Beneficiary Name" class="input">

                <input type="text" name="bank_name" value="{{ old('bank_name', $setting->bank_name) }}"
                    placeholder="Bank Name" class="input">

                <input type="text" name="bank_account_number" value="{{ old('bank_account_number', $setting->bank_account_number) }}"
                    placeholder="Account Number" class="input">

                <input type="text" name="ifsc_code" value="{{ old('ifsc_code', $setting->ifsc_code) }}"
                    placeholder="IFSC / SWIFT" class="input">

                <input type="text" name="iban_number" value="{{ old('iban_number', $setting->iban_number) }}"
                    placeholder="IBAN" class="input">
            </div>
        </div>


        <!-- 🔹 Invoice Settings -->
        <div class="bg-white shadow rounded-xl p-6">
            <h3 class="font-semibold text-lg mb-4 border-b pb-2">Invoice Settings</h3>

            <div class="grid md:grid-cols-2 gap-4">

                <input type="text" name="currency" value="{{ old('currency', $setting->currency) }}"
                    placeholder="Currency (INR / AED)" class="input">

                <input type="text" name="currency_symbol" value="{{ old('currency_symbol', $setting->currency_symbol) }}"
                    placeholder="Symbol (₹ / د.إ)" class="input">

                <input type="text" name="invoice_prefix" value="{{ old('invoice_prefix', $setting->invoice_prefix) }}"
                    placeholder="Invoice Prefix" class="input">

                <input type="text" name="estimate_prefix" value="{{ old('estimate_prefix', $setting->estimate_prefix) }}"
                    placeholder="Estimate Prefix" class="input">
            </div>
        </div>


        <!-- 🔹 Uploads -->
        <div class="bg-white shadow rounded-xl p-6">
            <h3 class="font-semibold text-lg mb-4 border-b pb-2">Uploads</h3>

            <div class="grid md:grid-cols-2 gap-4">

                <div>
                    <label>Logo</label>
                    @if($setting->company_logo)
                        <img src="{{ asset('storage/'.$setting->company_logo) }}" class="h-12 mb-2">
                    @endif
                    <input type="file" name="company_logo" class="input">
                </div>

                <div>
                    <label>Signature</label>
                    @if($setting->authorized_signature)
                        <img src="{{ asset('storage/'.$setting->authorized_signature) }}" class="h-12 mb-2">
                    @endif
                    <input type="file" name="authorized_signature" class="input">
                </div>

            </div>
        </div>


        <!-- 🔹 Submit -->
        <div class="text-right">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg">
                Save Settings
            </button>
        </div>

    </form>

</div>

<style>
    .input {
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px 12px;
    outline: none;
}

.input:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 2px rgba(79,70,229,0.2);
}
</style>

@endsection