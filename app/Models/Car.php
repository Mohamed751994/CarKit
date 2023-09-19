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

    Public function getImageAttribute($value)
    {
        return $this->image_full_path($value);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
