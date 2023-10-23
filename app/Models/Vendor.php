<?php

namespace App\Models;

use App\Traits\MainTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
{
    use MainTrait;
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return  $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getImageAttribute($value)
    {
        if(!$value)
            return null;
        else
            return $this->image_full_path($value);
    }

    public function scopeFeatured($query)
    {
        return $query->whereFeatured(1);
    }
    public function scopeActive($query)
    {
        return $query->whereStatus(1);
    }

}
