<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'min_amount',
        'max_amount',
        'charges',
        'charge_type',
        'type',
        'bank_name',
        'account_name',
        'account_number',
        'code',
        'bar_code',
        'wallet_address',
        'wallet_type',
        'wallet_network',
        'icon',
        'status',
        'type_for',
        'optional_note',
    ];
}
