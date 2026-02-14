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
    Schema::create('estimate_items', function (Blueprint $table) {
        $table->id();

        $table->foreignId('estimate_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->string('title');
        $table->text('description')->nullable();

        $table->decimal('quantity', 10, 2)->default(1);
        $table->decimal('rate', 15, 2)->default(0);
        $table->decimal('amount', 15, 2)->default(0);

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimates');
    }
};
