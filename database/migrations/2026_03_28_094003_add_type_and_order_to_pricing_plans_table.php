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
    Schema::table('pricing_plans', function (Blueprint $table) {
        $table->string('type')->nullable()->after('name');
        $table->integer('order')->default(0)->after('type');
    });
}

public function down()
{
    Schema::table('pricing_plans', function (Blueprint $table) {
        $table->dropColumn(['type', 'order']);
    });
}
};
