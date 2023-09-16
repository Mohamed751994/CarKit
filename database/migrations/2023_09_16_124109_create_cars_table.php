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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->string('year');
            $table->string('fuel_type');
            $table->string('motor_type');
            $table->string('cc')->nullable();
            $table->string('kilometers')->nullable();
            $table->string('color');
            $table->string('seats')->nullable();
            $table->string('doors')->nullable();
            $table->string('outside_look')->nullable();
            $table->text('additions')->nullable();
            $table->string('image')->nullable();
            $table->double('price_per_day')->nullable();
            $table->string('central_point_pickup')->nullable();
            $table->string('features')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
