<?php

namespace App\Http\Controllers\API\WebsiteControllers;

use App\Http\Requests\WishlistRequest;
use App\Models\Car;
use App\Models\User;
use App\Models\Wishlist;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class WishlistController extends Controller
{
    use MainTrait;


    //add to wishlist
    public function add_to_wishlist(WishlistRequest $request)
    {
        try {
            $data = $request->validated();
            $wishlistData = ['user_id' => $this->user_id(), 'car_id' =>$data['car_id']];
            $wishlist = Wishlist::where($wishlistData);
            if($wishlist->exists())
            {
                $wishlist->delete();
                $message = 'تم حذف السيارة من مفضلتك';
            }
            else
            {
                Wishlist::create($wishlistData);
                $message = 'تم إضافة السيارة إلي مفضلتك';
            }
            return $this->successResponse($message);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }


    //Get All Wishlists of user
    public function wishlists()
    {
        return $this->successResponse('السيارات المفضلة',auth()->user()->wishlistsCar);
    }


}
