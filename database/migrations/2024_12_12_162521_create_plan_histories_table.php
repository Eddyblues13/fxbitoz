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
        Schema::create('plan_histories', function (Blueprint $table) {
            $table->id(); // Equivalent to `bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT`
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key constraint
            $table->string('plan'); // Equivalent to `varchar(255) NOT NULL`
            $table->decimal('amount', 15, 2); // Equivalent to `decimal(15,2) NOT NULL`
            $table->string('type'); // Equivalent to `varchar(255) NOT NULL`
            $table->timestamps(); // Equivalent to `created_at` and `updated_at`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_histories');
    }
};
