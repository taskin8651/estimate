<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [

        // 🌍 Company Info
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'company_logo',
        'company_website',
        'company_city',
        'company_state',
        'company_country',
        'company_zip',

        // 🇮🇳 India Specific (optional)
        'gst_number',
        'pan_number',
        'cin_number',

        // 🇦🇪 UAE Specific (optional)
        'trade_license_number',

        // 🏦 Bank Details
        'bank_beneficiary_name',
        'bank_name',
        'bank_account_number',
        'iban_number',
        'swift_code',
        'ifsc_code',

        // 💰 Invoice Settings
        'currency',
        'currency_symbol',
        'invoice_prefix',
        'estimate_prefix',
        'invoice_start_number',
        'payment_terms',
        'payment_due_days',

        // 📄 Extra
        'authorized_signature',
        'company_stamp',
        'terms_conditions',
        'notes',

        // 👤 User
        'created_by',
    ];

    // 🔹 Relationship
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}