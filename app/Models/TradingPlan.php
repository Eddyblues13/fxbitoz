<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'icon_url',
        'title',
        'hourly_return',
        'min_investment',
        'max_investment',
        'capital_back',
        'return_type',
        'number_of_periods',
        'profit_withdrawal',
        'cancellation_policy',
        'profit_holidays',
        'duration_days',
        'daily_profit',
        'is_featured',
        'order',
        'is_active',
    ];

    protected $casts = [
        'capital_back' => 'boolean',
        'profit_holidays' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'min_investment' => 'decimal:2',
        'max_investment' => 'decimal:2',
        'daily_profit' => 'decimal:2',
    ];

    public function getDailyProfitAttribute($value)
    {
        return $value / 100; // Convert from percentage to decimal
    }

    public function setDailyProfitAttribute($value)
    {
        $this->attributes['daily_profit'] = $value * 100; // Convert from decimal to percentage
    }

    // Scope for active plans
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for featured plans
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope ordered by the order field
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
