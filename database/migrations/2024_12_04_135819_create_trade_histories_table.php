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
        Schema::create('trade_histories', function (Blueprint $table) {
            $table->id(); // bigint(20) UNSIGNED NOT NULL
            $table->unsignedBigInteger('user_id'); // bigint(20) UNSIGNED NOT NULL
            $table->string('user_email', 250)->nullable(); // varchar(250) DEFAULT NULL
            $table->string('status'); // varchar(255) NOT NULL
            $table->string('trader_name'); // varchar(255) NOT NULL
            $table->string('trader_image'); // varchar(255) NOT NULL
            $table->string('asset'); // varchar(255) NOT NULL
            $table->string('amount'); // varchar(255) NOT NULL
            $table->string('roi'); // varchar(255) NOT NULL
            $table->string('trade_duration')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('top_up_interval', 250)->nullable(); // varchar(250) DEFAULT NULL
            $table->string('subscription_day', 250)->nullable(); // varchar(250) DEFAULT NULL
            $table->string('subscription_hour', 250)->nullable(); // varchar(250) DEFAULT NULL
            $table->timestamps(); // created_at and updated_at
            $table->timestamp('expired_at')->nullable(); // timestamp NULL DEFAULT NULL
            // Foreign key constraint to link with users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_histories');
    }
};
