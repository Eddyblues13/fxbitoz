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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('deposit_type'); // Type of deposit (e.g., bank transfer, cryptocurrency)
            $table->string('status');
            $table->decimal('amount', 15, 2); // Amount of the deposit
            $table->string('payment_mode'); // Payment mode used
            $table->string('proof')->nullable(); // Path to the proof file (nullable)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
