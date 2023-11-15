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
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title')->nullable();
            $table->string('keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('author')->nullable();
            $table->string('og_type')->nullable();
            $table->string('og_url')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_site_name')->nullable();
            $table->string('canonical')->nullable();
            $table->string('image_src')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_image_url')->nullable();
            $table->string('itemprop_name')->nullable();
            $table->string('itemprop_image')->nullable();
            $table->string('twitter_title')->nullable();
            $table->string('twitter_url')->nullable();
            $table->text('twitter_card')->nullable();
            $table->string('twitter_site')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_creator')->nullable();
            $table->string('twitter_image')->nullable();
            $table->string('microdata_name')->nullable();
            $table->string('microdata_type')->nullable();
            $table->string('microdata_image1')->nullable();
            $table->string('microdata_image2')->nullable();
            $table->string('microdata_image3')->nullable();
            $table->text('microdata_description')->nullable();
            $table->string('microdata_ratingValue')->nullable();
            $table->string('microdata_bestRating')->nullable();
            $table->string('microdata_offer_priceCurrency')->nullable();
            $table->string('microdata_offer_price')->nullable();
            $table->date('microdata_offer_price_valid_until')->nullable();
            $table->text('google_tag_manager')->nullable();
            $table->text('google_tag_manager_in_body')->nullable();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
