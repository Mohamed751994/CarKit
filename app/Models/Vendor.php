<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return  $this->belongsTo('App\Models\User', 'user_id');
    }

    public function car(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
