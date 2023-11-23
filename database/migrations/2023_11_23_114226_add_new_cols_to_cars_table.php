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
        Schema::table('cars', function (Blueprint $table) {
            $table->text('imagesList')->nullable()->after('image');
            $table->text('license')->after('imagesList');
            $table->text('comfort_additions')->after('license');
            $table->text('safety_additions')->after('comfort_additions');
            $table->text('sound_additions')->after('safety_additions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            //
        });
    }
};
