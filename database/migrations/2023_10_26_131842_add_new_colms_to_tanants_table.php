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
            $table->integer('days')->default(0)->nullable()->after('to_date');
            $table->integer('discount_percentage')->default(0)->nullable()->after('days');
            $table->float('total_amount')->default(0)->nullable()->after('discount_percentage');
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
