<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MainTrait;


class Tanant extends Model
{
    use HasFactory;
    use MainTrait;
    protected $guarded = ['id'];
    protected $appends = ['status_array'];


    protected $casts = [
        'car_details' => 'json',
        'car_features' => 'array',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
    public function vendor_user()
    {
        return $this->belongsTo(User::class, 'vendor_user_id');
    }

    public function normal_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getNidImgAttribute($value)
    {
        return $this->image_full_path($value);
    }
    public function getLicenseImgAttribute($value)
    {
        return $this->image_full_path($value);
    }

    public function getStatusAttribute($value)
    {
        $item = '';
        if (\Request::is('api/*')) {
            return $value;
        }
        else
        {
            if($value == 'pending')
            {
                $item =  '<span class="badge  bg-light-warning text-warning w-50"> في الإنتظار</span>';
            }
            elseif($value == 'payment_pending')
            {
                $item =  '<span class="badge  bg-light-success text-success w-50">بإنتظار الدفع </span>';
            }
            elseif($value == 'approved')
            {
                $item =  '<span class="badge  bg-light-success text-success w-50">تم التأكيد</span>';
            }
            elseif($value == 'rejected')
            {
                $item =  '<span class="badge  bg-light-danger text-danger w-50">تم الرفض</span>';
            }
            elseif($value == 'cancelled')
            {
                $item =  '<span class="badge  bg-light-danger text-danger w-50">ملغي</span>';
            }
        }
        return $item;
    }

    public function getStatusArrayAttribute()
    {
        $item = [];
        if($this->status == 'pending')
        {
            $item =  ['color'=>'orange', 'status' =>' في الإنتظار'];
        }
        elseif($this->status == 'payment_pending')
        {
            $item =  ['color'=>'lightblue', 'status' =>'بإنتظار الدفع '];
        }
        elseif($this->status == 'approved')
        {
            $item =  ['color'=>'green', 'status' =>'تم التأكيد '];
        }
        elseif($this->status == 'rejected')
        {
            $item =  ['color'=>'red', 'status' =>'تم الرفض '];
        }
        elseif($this->status == 'cancelled')
        {
            $item =  ['color'=>'red', 'status' =>'تم الإلغاء '];
        }

        return $item;
    }


    //Car Features
    public function getCarFeaturesAttribute($value)
    {
        if(!$value)
        {
            return null;
        }
        else
        {
            $features = [];
            foreach (json_decode($value) as $item)
            {
                array_push($features, $item);
            }
            return $features;
        }
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


}
