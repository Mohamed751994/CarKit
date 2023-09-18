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
        Schema::create('tanants', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('user_id')->nullable()->default(null);
            $table->string('fname'); 
            $table->string('lname'); 
            $table->integer('age');
            $table->string('email');
            $table->string('phone');
            $table->string('trip_num')->unique();
            $table->string('nid_img');
            $table->string('license_img');
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('car_id');
            $table->integer('vendor_user_id');
            $table->json('car_details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanants');
    }
};
