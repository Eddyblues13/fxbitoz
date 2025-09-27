<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->string('asset'); // Asset being traded (e.g., "lyxe")
            $table->string('category'); // Trade category (e.g., "stocks", "crypto")
            $table->string('company'); // Company related to the trade
            $table->decimal('amount', 15, 2); // Trade amount
            $table->decimal('take_profit', 10, 2)->nullable(); // Optional take-profit value
            $table->decimal('stop_loss', 10, 2)->nullable(); // Optional stop-loss value
            $table->timestamps(); // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trades');
    }
}
