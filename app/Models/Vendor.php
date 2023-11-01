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
    protected $appends = ['rate', 'count_rate', 'rate_percentage'];
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

    //Avg Rating
    public function getRateAttribute()
    {
        return floatval($this->rating($this->user_id, 'vendor'));
    }

    //Count Rating
    public function getCountRateAttribute()
    {
        return Rating::where('type_id', $this->user_id)->whereType('vendor')->count();
    }
    //Rating percentage
    public function getRatePercentageAttribute()
    {
        $array = [];
        for ($i=1 ; $i<=5; $i++)
        {
            $rateNumber = Rating::where('type_id', $this->user_id)->whereType('vendor')->whereRate($i)->count();
            $totalPercentage = ($this->getCountRateAttribute() > 0) ? ($rateNumber / $this->getCountRateAttribute()) * 100 : 0;
            array_push($array , [$i => $totalPercentage]);
        }
        return $array ;
    }

}
