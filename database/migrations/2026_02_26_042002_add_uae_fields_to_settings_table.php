<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {

            // 🔹 Tax (UAE)
            $table->string('trn_number')->nullable()->after('company_logo');
            $table->decimal('vat_percentage', 5, 2)->default(5.00)->after('trn_number');
            $table->string('trade_license_number')->nullable()->after('vat_percentage');

            // 🔹 Bank Details
            $table->string('bank_beneficiary_name')->nullable()->after('trade_license_number');
            $table->string('bank_name')->nullable()->after('bank_beneficiary_name');
            $table->string('bank_account_number')->nullable()->after('bank_name');
            $table->string('iban_number')->nullable()->after('bank_account_number');
            $table->string('swift_code')->nullable()->after('iban_number');

            // 🔹 Invoice Settings
            $table->string('currency')->default('AED')->after('swift_code');
            $table->string('invoice_prefix')->default('INV-')->after('currency');
            $table->string('estimate_prefix')->default('EST-')->after('invoice_prefix');
            $table->string('payment_terms')->nullable()->after('estimate_prefix');
            $table->string('authorized_signature')->nullable()->after('payment_terms');

        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
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
            ]);
        });
    }
};