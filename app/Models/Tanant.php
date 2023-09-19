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

    Public function getNidImgAttribute($value)
    {
        return $this->image_full_path($value);
    }
    Public function getLicenseImgAttribute($value)
    {
        return $this->image_full_path($value);
    }
}
