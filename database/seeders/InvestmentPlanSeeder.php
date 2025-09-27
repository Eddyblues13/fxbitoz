<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InvestmentPlan;
use App\Models\TradingPlan;

class InvestmentPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Rookie',
                'slug' => 'rookie',
                'title' => '2% DAILY FOR 7 DAYS',
                'hourly_return' => 'Hour 2%',
                'min_investment' => 1000,
                'max_investment' => 10000,
                'capital_back' => true,
                'return_type' => 'Period',
                'number_of_periods' => 15,
                'profit_withdrawal' => 'Anytime',
                'cancellation_policy' => 'Within 59 Minute',
                'profit_holidays' => false,
                'duration_days' => 7,
                'daily_profit' => 2,
                'is_featured' => false,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Enthusiast',
                'slug' => 'enthusiast',
                'title' => '4% DAILY FOR 15 DAYS',
                'hourly_return' => 'Hour 4%',
                'min_investment' => 10000,
                'max_investment' => 30000,
                'capital_back' => true,
                'return_type' => 'Period',
                'number_of_periods' => 30,
                'profit_withdrawal' => 'Anytime',
                'cancellation_policy' => 'No',
                'profit_holidays' => false,
                'duration_days' => 15,
                'daily_profit' => 4,
                'is_featured' => false,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Professional',
                'slug' => 'professional',
                'title' => '6% DAILY FOR 30 DAYS',
                'hourly_return' => 'Hour 6%',
                'min_investment' => 40000,
                'max_investment' => 100000,
                'capital_back' => true,
                'return_type' => 'Period',
                'number_of_periods' => 30,
                'profit_withdrawal' => 'Anytime',
                'cancellation_policy' => 'No',
                'profit_holidays' => false,
                'duration_days' => 30,
                'daily_profit' => 6,
                'is_featured' => false,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Master-Recommended',
                'slug' => 'master-recommended',
                'title' => '10% DAILY FOR 30 DAYS',
                'hourly_return' => 'Hour 10%',
                'min_investment' => 100000,
                'max_investment' => 850000,
                'capital_back' => true,
                'return_type' => 'Period',
                'number_of_periods' => 168,
                'profit_withdrawal' => 'Anytime',
                'cancellation_policy' => 'No',
                'profit_holidays' => false,
                'duration_days' => 30,
                'daily_profit' => 10,
                'is_featured' => true,
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            TradingPlan::create($plan);
        }
    }
}
