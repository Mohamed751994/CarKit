<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\MainTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,MainTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'phone',
        'image',
        'email_verified_at'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getImageAttribute($value)
    {
        if(!$value)
            return null;
        else
            return $this->image_full_path($value);
    }


    public function getTypeAttribute($value)
    {
        $array = ['user', 'admin', 'vendor'];
        return $array[$value];
    }


    public function vendor()
    {
       return $this->hasOne('App\Models\Vendor', 'user_id');
    }


    public function cars()
    {
        return $this->hasMany(Car::class, 'user_id');
    }


    //Normal User Reservations
    public function reservations()
    {
        return $this->hasMany('App\Models\Tanant', 'user_id');
    }



    protected static function booted()
    {
        static::created(function ($item) {
            activityLog('create',$item->getTable(), $item);
        });

        static::updated(function ($item) {
            activityLog('update',$item->getTable(), $item);
        });
        static::deleting(function ($item) {
            activityLog('delete',$item->getTable(), $item);
        });
    }

    public function logs()
    {
        return $this->hasMany(ActivityLog::class, 'user_id');
    }


    public function wishlistsCar()
    {
        return $this->belongsToMany(Car::class, 'wishlists', 'user_id','car_id');
    }

}
