<?php

namespace App\Http\Controllers\API\WebsiteControllers;

use App\Http\Requests\WishlistRequest;
use App\Models\Car;
use App\Models\User;
use App\Models\Wishlist;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SettingController extends Controller
{
    use MainTrait;

    //Get terms and conditions
    public function settings($col)
    {
        return $this->successResponse($col,getSettings($col));
    }


}
