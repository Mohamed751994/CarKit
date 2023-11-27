<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\MainTrait;
use Illuminate\Support\Facades\Auth;

class Car extends Model
{
    use HasFactory;
    use MainTrait;
    protected $guarded = [];
    protected $casts = [
        'images' =>'array',
        'license' =>'array',
    ];
    public function getImageAttribute($value)
    {
        if(!$value)
            return null;
        else
            return $this->image_full_path($value);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function features()
    {
        return $this->hasMany(CarFeature::class, 'car_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function brands()
    {
        return $this->belongsTo(CarsBrand::class, 'brand', 'id');
    }

    public function reservations()
    {
        return $this->hasMany(Tanant::class, 'car_id');
    }

    public function scopeVendorStatus($query)
    {
        return $query->whereHas('user.vendor', function($q) {
            $q->where('status', 1);
        });
    }

    //Filtration
    public function scopeFilter($query, $params)
    {
        if ( isset($params['user_ids'])) {
            $query->whereIn('user_id', $params['user_ids']);
        }
        if ( isset($params['brand_ids'])) {
            $query->whereIn('brand', $params['brand_ids']);
        }
        if ( isset($params['motor_types'])) {
            $query->whereIn('motor_type', $params['motor_types']);
        }
        if ( isset($params['colors'])) {
            $query->whereIn('color', $params['colors']);
        }
        if ( isset($params['prices'])) {
            $query->whereBetween('price_per_day', $params['prices']);
        }
        if ( isset($params['sortByPrice'])) {
            $query->orderBy('price_per_day', $params['sortByPrice']); // $params['sortBy'] = ASC or DESC
        }
        return $query;
    }


    //Search
    public function scopeSearch($query, $params)
    {
        return $query->where(
            [
                'brand' =>$params['brand_id'],
                'motor_type' =>$params['motor_type']
            ])->whereBetween('price_per_day', [$params['price_from'], $params['price_to']]);
    }



    public function wishlistsUser()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'car_id', 'user_id');
    }

    public function getImagesAttribute($value)
    {
        if(!$value)
        {
            return null;
        }
        else
        {
            $fullPath = [];
            foreach(json_decode($value) as $v)
            {
                array_push($fullPath, $this->image_full_path($v));
            }
             array_unshift( $fullPath,$this->image);
            return $fullPath;
        }
    }
    public function getLicenseAttribute($value)
    {
        return $this->image_full_path_for_array($value);
    }



    //Booted
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


}
