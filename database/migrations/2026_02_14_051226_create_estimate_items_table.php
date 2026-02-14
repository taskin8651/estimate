<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('estimates', function (Blueprint $table) {
        $table->id();

        $table->string('estimate_number')->unique();
        $table->foreignId('client_id')->constrained()->cascadeOnDelete();

        $table->date('issue_date');
        $table->date('expiry_date')->nullable();

        $table->decimal('subtotal', 15, 2)->default(0);
        $table->decimal('tax_percentage', 5, 2)->default(0);
        $table->decimal('tax_amount', 15, 2)->default(0);
        $table->decimal('total', 15, 2)->default(0);

        $table->enum('status', ['draft', 'sent', 'accepted', 'rejected'])
              ->default('draft');

        $table->text('notes')->nullable();

        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimate_items');
    }
};
