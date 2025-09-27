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
        Schema::create('stocks', function (Blueprint $table) {
            $table->string('stock_name')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('stock_max_amount')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('stock_min_amount')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('stock_js')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('stock_graph')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('top_up_amount')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('top_up_interval')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('top_up_type')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('investment_duration')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('top_up_status')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('performance')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('copier_roi')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('years_of_experience')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('picture')->nullable(); // varchar(255) DEFAULT NULL
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
