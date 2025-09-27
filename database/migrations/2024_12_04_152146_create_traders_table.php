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
        Schema::create('traders', function (Blueprint $table) {
            $table->id();
            $table->string('trader_name'); // varchar(255) NOT NULL
            $table->string('trading_max_amount'); // varchar(255) NOT NULL
            $table->string('trading_min_amount'); // varchar(255) NOT NULL
            $table->string('top_up_interval'); // varchar(255) NOT NULL
            $table->string('top_up_type'); // varchar(255) NOT NULL
            $table->string('top_up_amount'); // varchar(255) NOT NULL
            $table->string('investment_duration'); // varchar(255) NOT NULL
            $table->string('trader_year_of_experience'); // varchar(255) NOT NULL
            $table->string('copier_roi'); // varchar(255) NOT NULL
            $table->string('risk_index'); // varchar(255) NOT NULL
            $table->string('performance'); // varchar(255) NOT NULL
            $table->string('total_copied_trade'); // varchar(255) NOT NULL
            $table->string('active_traders'); // varchar(255) NOT NULL
            $table->string('trader_country'); // varchar(255) NOT NULL
            $table->string('about_trader', 500); // varchar(500) NOT NULL
            $table->string('picture'); // varchar(255) NOT NULL
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traders');
    }
};
