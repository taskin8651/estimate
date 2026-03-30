<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // 🌍 Company Info
            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_state')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_zip')->nullable();

            // 🇮🇳 India
            $table->string('gst_number')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('cin_number')->nullable();

            // 🇦🇪 UAE
            $table->string('trade_license_number')->nullable();

            // 🏦 Bank Details
            $table->string('bank_beneficiary_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('iban_number')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('ifsc_code')->nullable();

            // 💰 Invoice Settings
            $table->string('currency')->nullable(); // INR / AED
            $table->string('currency_symbol')->nullable(); // ₹ / د.إ
            $table->string('invoice_prefix')->nullable();
            $table->string('estimate_prefix')->nullable();
            $table->integer('invoice_start_number')->default(1);
            $table->text('payment_terms')->nullable();
            $table->integer('payment_due_days')->nullable();

            // 📄 Extra
            $table->string('authorized_signature')->nullable();
            $table->string('company_stamp')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->text('notes')->nullable();

            // 👤 User (SaaS Support)
            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();

            // 🔗 Foreign Key
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};