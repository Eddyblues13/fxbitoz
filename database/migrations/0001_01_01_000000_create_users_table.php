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
            $table->string('username');
            $table->string('account_type')->nullable();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('status')->default('Active');
            $table->integer('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('btc_address')->nullable();
            $table->string('eth_address')->nullable();
            $table->string('ltc_address')->nullable();
            $table->string('email')->unique();
            $table->string('id_card')->nullable();
            $table->string('passport')->nullable();
            $table->string('kyc_status')->default('0');
            $table->string('address')->nullable();
            $table->string('user_address')->nullable();
            $table->string('dob')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('third_username')->nullable();
            $table->string('third_user_address')->nullable();
            $table->string('third_dob')->nullable();
            $table->string('third_employment_status')->nullable();
            $table->string('third_country')->nullable();
            $table->string('third_phone')->nullable();
            $table->string('third_name')->nullable();
            $table->string('third_address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
