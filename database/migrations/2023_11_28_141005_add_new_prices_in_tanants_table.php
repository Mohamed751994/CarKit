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
            $table->integer('price_per_day')->default(0)->nullable()->after('days');
            $table->integer('price_in_days')->default(0)->nullable()->after('price_per_day');
            $table->integer('prices_features')->default(0)->nullable()->after('price_in_days');
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
