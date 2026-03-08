@extends('layouts.admin')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="bg-white shadow-lg rounded-xl p-6 sm:p-8">

        <h2 class="text-2xl sm:text-3xl font-bold mb-6">
            Company Settings
        </h2>

        @if(session('success'))
            <div class="mb-6 bg-green-100 text-green-700 p-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-8">
            @csrf

            <!-- Company Basic Info -->
            <div>
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">
                    Basic Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Company Name
                        </label>
                        <input type="text"
                               name="company_name"
                               value="{{ old('company_name', $setting->company_name) }}"
                               class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Company Email
                        </label>
                        <input type="email"
                               name="company_email"
                               value="{{ old('company_email', $setting->company_email) }}"
                               class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Company Phone
                        </label>
                        <input type="text"
                               name="company_phone"
                               value="{{ old('company_phone', $setting->company_phone) }}"
                               class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Company Website
                        </label>
                        <input type="text"
                               name="company_website"
                               value="{{ old('company_website', $setting->company_website) }}"
                               class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium mb-2">
                        Company Address
                    </label>
                    <textarea name="company_address"
                              rows="3"
                              class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">{{ old('company_address', $setting->company_address) }}</textarea>
                </div>
                

                <div class="mt-6">
                    <label class="block text-sm font-medium mb-2">
                        Company Logo
                    </label>

                    @if($setting->company_logo)
                        <div class="mb-3">
                            <img src="{{ asset('storage/'.$setting->company_logo) }}"
                                 class="h-16 rounded shadow">
                        </div>
                    @endif

                    <input type="file"
                           name="company_logo"
                           class="w-full border rounded-lg px-4 py-2">
                </div>
            </div>

            <!-- UAE Tax & Bank Info -->
            <div>
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">
                    UAE Tax & Bank Details
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            TRN Number
                        </label>
                        <input type="text"
                               name="trn_number"
                               value="{{ old('trn_number', $setting->trn_number) }}"
                               class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            VAT Percentage (%)
                        </label>
                        <input type="number"
                               step="0.01"
                               name="vat_percentage"
                               value="{{ old('vat_percentage', $setting->vat_percentage) }}"
                               class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Beneficiary Name
                        </label>
                        <input type="text"
                               name="bank_beneficiary_name"
                               value="{{ old('bank_beneficiary_name', $setting->bank_beneficiary_name) }}"
                               class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Bank Name
                        </label>
                        <input type="text"
                               name="bank_name"
                               value="{{ old('bank_name', $setting->bank_name) }}"
                               class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Account Number
                        </label>
                        <input type="text"
                               name="bank_account_number"
                               value="{{ old('bank_account_number', $setting->bank_account_number) }}"
                               class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            IBAN Number
                        </label>
                        <input type="text"
                               name="iban_number"
                               value="{{ old('iban_number', $setting->iban_number) }}"
                               class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Swift Code
                        </label>
                        <input type="text"
                               name="swift_code"
                               value="{{ old('swift_code', $setting->swift_code) }}"
                               class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div class="mt-6">
    <label class="block text-sm font-medium mb-2">
        Authorized Signature
    </label>

    @if($setting->authorized_signature)
        <div class="mb-3">
            <img src="{{ asset('storage/'.$setting->authorized_signature) }}"
                 class="h-20 rounded shadow">
        </div>
    @endif

    <input type="file"
           name="authorized_signature"
           class="w-full border rounded-lg px-4 py-2">
</div>

                </div>
            </div>

            <!-- Submit -->
            <div class="pt-6 border-t">
                <button type="submit"
                        class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                    Update Settings
                </button>
            </div>

        </form>

    </div>

</div>

@endsection