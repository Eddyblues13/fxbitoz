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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id(); // bigint(20) UNSIGNED NOT NULL
            $table->unsignedBigInteger('user_id'); // user_id
            $table->integer('amount'); // amount
            $table->string('withdraw_from'); // withdraw_from
            $table->string('method'); // method
            $table->string('status'); // status
            $table->string('details'); // details
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraint (assuming a `users` table exists)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
