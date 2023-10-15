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
            $vendors = Vendor::whereStatus(1)->orderBy('name')->select('user_id AS id', 'name')->get();
            return $this->successResponse('جميع المعارض', $vendors);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

}
