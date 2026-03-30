<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();

            // Basic Tax Info
            $table->string('name'); // GST 18%, VAT 5%
            $table->decimal('rate', 8, 2); // 18.00

            // Type & Country
            $table->string('type')->nullable(); // GST / VAT
            $table->string('country')->nullable(); // India / UAE

            // Controls
            $table->boolean('is_default')->default(false);
            $table->boolean('status')->default(true);

            // User
            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();

            // Foreign Key (optional but recommended)
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};