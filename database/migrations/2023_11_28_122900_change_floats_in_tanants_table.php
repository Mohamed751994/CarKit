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
        Schema::table('tanants', function (Blueprint $table) {
            $table->float('total_amount', 10, 8)->default(0)->nullable()->change();
            $table->float('total_amount_after_discount', 10, 8)->default(0)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tanants', function (Blueprint $table) {
            //
        });
    }
};
