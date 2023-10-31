<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Requests\CarRequest;
use App\Http\Requests\CarReservationRequest;


use App\Models\Car;
use App\Models\CarsBrand;
use App\Models\CarsModel;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Tanant;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    use MainTrait;


    //Get All Vendors to filtration
    public function get_all_vendors()
    {
        try {
            $vendors = Vendor::active()->orderBy('name')->select('user_id AS id', 'name', 'user_id')->get();
            return $this->successResponse('جميع المعارض', $vendors);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }


    //Get All Featured Vendors
    public function get_all_featured_vendors()
    {
        try {
            $vendors = Vendor::active()->featured()->get();
            return $this->successResponse('جميع المعارض المميزة', $vendors);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    //Get Single Featured Vendor
    public function get_single_featured_vendor($id)
    {
        try {
            $vendor = Vendor::with('user.cars')->active()->whereId($id)->first();
            if(!$vendor)
            {
                return $this->errorResponse('الصفحة غير موجودة',404);
            }
            return $this->successResponse('صفحة المعرض المميزة', $vendor);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

}
