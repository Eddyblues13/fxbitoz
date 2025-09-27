<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'account_type',
        'name',
        'phone',
        'country',
        'date_of_birth',
        'role',
        'status',
        'bank_name',
        'account_name',
        'account_number',
        'swift_code',
        'btc_address',
        'eth_address',
        'ltc_address',
        'email',
        'id_card',
        'passport',
        'kyc_status',
        'address',
        'user_address',
        'dob',
        'employment_status',
        'third_username',
        'third_user_address',
        'third_dob',
        'third_employment_status',
        'third_country',
        'third_phone',
        'third_name',
        'third_address',
        'referred_by',
        'email_verified_at',
        'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // app/Models/User.php
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    // Generating a unique referral code
    public function generateReferralCode()
    {
        $this->referral_code = strtoupper(substr(md5(uniqid()), 0, 8));
        $this->save();
    }


    public function accountBalance()
    {
        return $this->hasOne(AccountBalance::class);
    }

    public function profits()
    {
        return $this->hasMany(Profit::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function trade()
    {
        return $this->hasOne(TradeHistory::class, 'user_id');
    }

    public function withdrawals()
    {
        return $this->hasOne(Withdrawal::class, 'user_id');
    }
}
