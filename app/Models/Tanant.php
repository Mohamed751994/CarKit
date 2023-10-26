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
            $status = ['pending', 'payment_pending','approved', 'rejected', 'cancelled'];
            if($status[0])
            {
                $item =  '<span class="badge  bg-light-warning text-warning w-50"> في الإنتظار</span>';
            }
            elseif($status[1])
            {
                $item =  '<span class="badge  bg-light-success text-success w-50">بإنتظار الدفع </span>';
            }
            elseif($status[2])
            {
                $item =  '<span class="badge  bg-light-success text-success w-50">تم التأكيد</span>';
            }
            elseif($status[3])
            {
                $item =  '<span class="badge  bg-light-danger text-danger w-50">تم الرفض</span>';
            }
            elseif($status[4])
            {
                $item =  '<span class="badge  bg-light-danger text-danger w-50">ملغي</span>';
            }
        }
        return $item;
    }

}
