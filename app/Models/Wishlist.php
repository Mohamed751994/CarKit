<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $guarded = [];

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
