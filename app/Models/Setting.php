<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
    'company_name',
    'company_email',
    'company_phone',
    'company_address',
    'company_logo',
    'company_website',

    'trn_number',
    'vat_percentage',
    'trade_license_number',

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

    'created_by',
];

    // 🔹 Setting belongs to User
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
