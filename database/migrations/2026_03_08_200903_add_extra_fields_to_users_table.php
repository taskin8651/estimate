<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

$table->string('company_name')->nullable();

$table->boolean('status')->default(1);

$table->date('joining_date')->nullable();
$table->date('expiry_date')->nullable();

$table->unsignedBigInteger('plan_id')->nullable();

$table->string('subscription_status')->default('trial');

$table->timestamp('trial_ends_at')->nullable();
$table->timestamp('subscription_ends_at')->nullable();

$table->timestamp('last_login_at')->nullable();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
