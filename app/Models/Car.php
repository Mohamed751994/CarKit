<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\MainTrait;

class Car extends Model
{
    use HasFactory;
    use MainTrait;
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if(!$value)
            return null;
        else
            return $this->image_full_path($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reservations()
    {
        return $this->hasMany(Tanant::class, 'car_id');
    }


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



}
