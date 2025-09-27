<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'traders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trader_name',
        'trading_max_amount',
        'trading_min_amount',
        'top_up_interval',
        'top_up_type',
        'top_up_amount',
        'investment_duration',
        'trader_year_of_experience',
        'copier_roi',
        'risk_index',
        'performance',
        'total_copied_trade',
        'active_traders',
        'trader_country',
        'about_trader',
        'is_verified',
        'followers',
        'picture',
    ];
}
