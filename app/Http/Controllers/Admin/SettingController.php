<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::firstOrCreate(
            ['created_by' => auth()->id()],
            ['created_by' => auth()->id()]
        );

        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            // Basic Info
            'company_name' => 'required|string|max:255',
            'company_email' => 'nullable|email|max:255',
            'company_phone' => 'nullable|string|max:50',
            'company_address' => 'nullable|string',

            // UAE Tax
            'trn_number' => 'nullable|string|max:100',
            'vat_percentage' => 'nullable|numeric|min:0|max:100',

            // Bank Details
            'bank_beneficiary_name' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:100',
            'iban_number' => 'nullable|string|max:100',
            'swift_code' => 'nullable|string|max:50',

            // Invoice Settings
            'currency' => 'nullable|string|max:10',
            'invoice_prefix' => 'nullable|string|max:20',
            'estimate_prefix' => 'nullable|string|max:20',
            'payment_terms' => 'nullable|string|max:255',

            // Logo
            'company_logo' => 'nullable|image|max:2048',
            'authorized_signature' => 'nullable|image|max:2048',
            'company_website' => 'nullable|max:255',
        ]);

        $setting = Setting::firstOrCreate(
            ['created_by' => auth()->id()],
            ['created_by' => auth()->id()]
        );

        $data = $request->only([
            'company_name',
            'company_email',
            'company_phone',
            'company_address',
            'trn_number',
            'vat_percentage',
            'bank_beneficiary_name',
            'bank_name',
            'bank_account_number',
            'iban_number',
            'swift_code',
            'currency',
            'invoice_prefix',
            'estimate_prefix',
            'payment_terms',
            'authorized_signature',
            'company_website',
        ]);

        // Default UAE settings
        $data['currency'] = $data['currency'] ?? 'AED';
        $data['vat_percentage'] = $data['vat_percentage'] ?? 5.00;

        // Logo Upload
        if ($request->hasFile('company_logo')) {

            // Delete old logo
            if ($setting->company_logo && Storage::disk('public')->exists($setting->company_logo)) {
                Storage::disk('public')->delete($setting->company_logo);
            }

            $data['company_logo'] = $request->file('company_logo')
                                            ->store('company', 'public');
        }

        // Authorized Signature Upload
if ($request->hasFile('authorized_signature')) {

    if ($setting->authorized_signature &&
        Storage::disk('public')->exists($setting->authorized_signature)) {
        Storage::disk('public')->delete($setting->authorized_signature);
    }

    $data['authorized_signature'] = $request->file('authorized_signature')
                                           ->store('signature', 'public');
}

        $setting->update($data);

        return back()->with('success', 'Settings Updated Successfully');
    }
}