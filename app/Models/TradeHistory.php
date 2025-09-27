<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeHistory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trade_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_email',
        'status',
        'trader_name',
        'trader_image',
        'asset',
        'amount',
        'roi',
        'trade_duration',
        'top_up_interval',
        'subscription_day',
        'subscription_hour',
        'expired_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
