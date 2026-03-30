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

            // 🌍 Company Info
            'company_name' => 'required|string|max:255',
            'company_email' => 'nullable|email|max:255',
            'company_phone' => 'nullable|string|max:50',
            'company_address' => 'nullable|string',
            'company_website' => 'nullable|max:255',

            // 🌍 Location
            'company_city' => 'nullable|string|max:100',
            'company_state' => 'nullable|string|max:100',
            'company_country' => 'nullable|string|max:100',
            'company_zip' => 'nullable|string|max:20',

            // 🇮🇳 India
            'gst_number' => 'nullable|string|max:100',
            'pan_number' => 'nullable|string|max:50',
            'cin_number' => 'nullable|string|max:50',

            // 🇦🇪 UAE
            'trade_license_number' => 'nullable|string|max:100',

            // 🏦 Bank
            'bank_beneficiary_name' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:100',
            'iban_number' => 'nullable|string|max:100',
            'swift_code' => 'nullable|string|max:50',
            'ifsc_code' => 'nullable|string|max:50',

            // 💰 Invoice
            'currency' => 'nullable|string|max:10',
            'currency_symbol' => 'nullable|string|max:10',
            'invoice_prefix' => 'nullable|string|max:20',
            'estimate_prefix' => 'nullable|string|max:20',
            'invoice_start_number' => 'nullable|integer|min:1',
            'payment_terms' => 'nullable|string',
            'payment_due_days' => 'nullable|integer|min:0',

            // 📄 Extra
            'terms_conditions' => 'nullable|string',
            'notes' => 'nullable|string',

            // 🖼️ Files
            'company_logo' => 'nullable|image|max:2048',
            'authorized_signature' => 'nullable|image|max:2048',
            'company_stamp' => 'nullable|image|max:2048',
        ]);

        $setting = Setting::firstOrCreate(
            ['created_by' => auth()->id()],
            ['created_by' => auth()->id()]
        );

        // ✅ Clean Data (NO TAX FIELDS)
        $data = $request->only([
            'company_name',
            'company_email',
            'company_phone',
            'company_address',
            'company_website',
            'company_city',
            'company_state',
            'company_country',
            'company_zip',

            'gst_number',
            'pan_number',
            'cin_number',
            'trade_license_number',

            'bank_beneficiary_name',
            'bank_name',
            'bank_account_number',
            'iban_number',
            'swift_code',
            'ifsc_code',

            'currency',
            'currency_symbol',
            'invoice_prefix',
            'estimate_prefix',
            'invoice_start_number',
            'payment_terms',
            'payment_due_days',

            'terms_conditions',
            'notes',
        ]);

        // 🔥 Default Values (smart)
        $data['currency'] = $data['currency'] ?? 'INR';
        $data['currency_symbol'] = $data['currency_symbol'] ?? '₹';
        $data['invoice_start_number'] = $data['invoice_start_number'] ?? 1;

        // 🖼️ Logo Upload
        if ($request->hasFile('company_logo')) {

            if ($setting->company_logo && Storage::disk('public')->exists($setting->company_logo)) {
                Storage::disk('public')->delete($setting->company_logo);
            }

            $data['company_logo'] = $request->file('company_logo')
                                           ->store('company', 'public');
        }

        // ✍️ Signature Upload
        if ($request->hasFile('authorized_signature')) {

            if ($setting->authorized_signature &&
                Storage::disk('public')->exists($setting->authorized_signature)) {
                Storage::disk('public')->delete($setting->authorized_signature);
            }

            $data['authorized_signature'] = $request->file('authorized_signature')
                                                   ->store('signature', 'public');
        }

        // 🏢 Stamp Upload
        if ($request->hasFile('company_stamp')) {

            if ($setting->company_stamp &&
                Storage::disk('public')->exists($setting->company_stamp)) {
                Storage::disk('public')->delete($setting->company_stamp);
            }

            $data['company_stamp'] = $request->file('company_stamp')
                                            ->store('stamp', 'public');
        }

        $setting->update($data);

        return back()->with('success', 'Settings Updated Successfully');
    }
}