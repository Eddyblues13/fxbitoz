<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stocks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stock_name',
        'stock_max_amount',
        'stock_min_amount',
        'stock_js',
        'stock_graph',
        'top_up_amount',
        'top_up_interval',
        'top_up_type',
        'investment_duration',
        'top_up_status',
        'performance',
        'copier_roi',
        'years_of_experience',
        'picture',
    ];
}
