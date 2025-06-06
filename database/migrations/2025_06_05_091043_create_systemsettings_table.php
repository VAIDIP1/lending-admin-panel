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
        Schema::create('systemsettings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('phone', 100)->nullable();
            $table->string('mobile', 100)->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->text('default_template')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('stripe_publish_key')->nullable();
            $table->string('stripe_secret_key')->nullable();
            $table->string('setting_key')->nullable();
            $table->string('setting_value')->nullable();
            $table->string('facebook_token')->nullable();
            $table->string('google_token')->nullable();
            $table->string('apple_token')->nullable();
            $table->timestamps();
            $table->foreignId('creator_id')->nullable()->constrained()->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete()->index('end_systemsettings_ibfk_1');
            $table->foreignId('updator_id')->nullable()->constrained()->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete()->index('end_systemsettings_ibfk_2');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('systemsettings');
    }
};
