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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete()->index('end_user_details_ibfk_1');
            $table->string('company_name')->nullable();
            $table->longText('company_details')->nullable();
            $table->longText('company_address')->nullable();
            $table->string('company_url', 255)->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_banner')->nullable();
            $table->integer('company_total_members')->nullable();
            $table->longText('company_highlights')->nullable();

            $table->string('country_name')->nullable();
            $table->string('state_name')->nullable();
            $table->string('city_name')->nullable();

            $table->foreignId('creator_id')->nullable()->constrained()->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete()->index('end_user_details_ibfk_6');
            $table->foreignId('updator_id')->nullable()->constrained()->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete()->index('end_user_details_ibfk_7');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
