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
        Schema::create('trading_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Rookie, Enthusiast, etc.
            $table->string('slug')->unique();
            $table->string('title'); // e.g. "2% DAILY FOR 7 DAYS"
            $table->string('hourly_return'); // e.g. "Hour 2%"
            $table->decimal('min_investment', 15, 2);
            $table->decimal('max_investment', 15, 2);
            $table->boolean('capital_back')->default(true);
            $table->string('return_type'); // e.g. "Period"
            $table->integer('number_of_periods');
            $table->string('profit_withdrawal'); // e.g. "Anytime"
            $table->string('cancellation_policy'); // e.g. "Within 59 Minute"
            $table->boolean('profit_holidays')->default(false);
            $table->integer('duration_days')->nullable(); // Plan duration in days
            $table->string('daily_profit'); // Daily profit percentage
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_plans');
    }
};
