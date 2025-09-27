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
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id(); // bigint(20) UNSIGNED NOT NULL
            $table->string('name')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('min_amount')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('max_amount')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('charges')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('charge_type')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('type')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('bank_name')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('account_name')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('account_number')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('code')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('bar_code', 250)->nullable(); // varchar(250) DEFAULT NULL
            $table->string('wallet_address', 250)->nullable(); // varchar(250) DEFAULT NULL
            $table->string('wallet_type', 250)->nullable(); // varchar(250) DEFAULT NULL
            $table->string('wallet_network', 250)->nullable(); // varchar(250) DEFAULT NULL
            $table->string('icon', 250)->nullable(); // varchar(250) DEFAULT NULL
            $table->string('status')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('type_for')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('optional_note')->nullable(); // varchar(255) DEFAULT NULL
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};
