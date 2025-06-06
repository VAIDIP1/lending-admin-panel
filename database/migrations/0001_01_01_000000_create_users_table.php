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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255);
            $table->unsignedTinyInteger('gender')->default(0)->comment('0 => Male, 1 => Female, 2 => Non-Binary, 3 => Prefer Not To Say');
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('mobile_number', 30)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('reset_password_token')->nullable();
            $table->string('profile_photo', 255)->default('sample.png')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('0 => Active, 1 => InActive, 2 => Blocked');
            $table->unsignedTinyInteger('is_emailverified')->default(0)->comment('1 => YES, 0 => NO');
            $table->dateTime('email_verified_at')->nullable();
            $table->string('email_token')->nullable();
            $table->unsignedTinyInteger('is_otpverified')->default(0)->comment('1 => YES, 0 => NO');
            $table->string('otp')->nullable();
            $table->dateTime('otp_generated_at')->nullable();
            $table->dateTime('otp_verified_at')->nullable();
            $table->string('otp_token')->nullable();

            $table->string('address', 255)->nullable();
            $table->string('website_url', 255)->nullable();
            
            $table->foreignId('creator_id')->nullable()->constrained()->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete()->index('end_users_ibfk_2');
            $table->foreignId('updator_id')->nullable()->constrained()->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete()->index('end_users_ibfk_3');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
