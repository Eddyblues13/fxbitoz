<?php

namespace Database\Seeders;

use App\Models\TradingPlan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TradingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TradingPlan::factory()->count(4)->create();
    }
}
