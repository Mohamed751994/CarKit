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


    protected $casts = [
        'car_details' => 'json'
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

}
