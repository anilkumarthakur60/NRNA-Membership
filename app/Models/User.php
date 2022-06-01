<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype',
        'street_address',
        'apartment',
        'city',
        'provience',
        'zip_code',
        'country',
        'state',
        'total',
        'image',
        'parent_id',
        'referal_code',
        'paymenttype_id',
        'membertype_id',
        'gender',
        'profession',
        'dob',
        'highest_degree',
        'area_of_expertise',
        'year_of_experience',
        'image',
        'skills'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function membertype()
    {
        return $this->belongsTo(Membertype::class);
    }
    public function paymenttype()
    {
        return $this->belongsTo(Paymenttype::class);
    }

    public function children()
    {
        return $this->hasOne(User::class, 'parent_id');
    }

    public function UserTypes()
    {
        return $this->belongsToMany(UserType::class);
    }

    public function paymentInfos()
    {
        return $this->hasMany(PaymentInfo::class);
    }

    public function scopePaymentInfoTotalAmount($query)
    {
        return $query->whereHas('paymentInfos', function ($voteQuery) {
            $voteQuery->sum('amount');
        });
    }
}
