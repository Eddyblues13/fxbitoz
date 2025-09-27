<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'asset',
        'category',
        'company',
        'amount',
        'take_profit',
        'stop_loss',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
