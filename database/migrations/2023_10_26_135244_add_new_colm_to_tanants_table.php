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
            $table->float('total_amount_after_discount')->default(0)->nullable()->after('total_amount');

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
