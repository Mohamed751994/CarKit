<?php

namespace App\Models;

use App\Traits\MainTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory,MainTrait;
    protected $guarded = [];

    public function getWebsiteLogoAttribute($value)
    {
        if(!$value)
            return null;
        else
            return $this->image_full_path($value);
    }
}
