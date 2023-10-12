<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarsModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function brand()
    {
        return $this->belongsTo(CarsBrand::class, 'brand_id');
    }
}
