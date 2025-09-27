<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandingSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
        'footer_logo',
        'email_logo',
        'favicon',
    ];
}
