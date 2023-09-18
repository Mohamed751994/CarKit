<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanant extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    protected $casts = [
        'car_details' => 'json'
    ];
}
