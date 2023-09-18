<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Requests\CarRequest;
use App\Http\Requests\CarReservationRequest;


use App\Models\Car;
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

class CarController extends Controller
{
    use MainTrait;

    public function get_all_cars()
    {
        try {

            $cars = Car::latest()->get();
            return $this->successResponse('جميع السيارات', $cars);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function get_single_car($id)
    {
        try {

            $car = Car::with('user.vendor')->findOrFail($id);
            return $this->successResponse('بيانات السيارة', $car);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function reserve_car(CarReservationRequest $request){
        try {

            $data = $request->validated();
            if ($request->hasFile('nid_img')) {
                $image = $this->uploadFile($request, 'nid_img', 'uploads/');
                $data['nid_img'] = $image;
            }
            if ($request->hasFile('license_img')) {
                $image = $this->uploadFile($request, 'license_img', 'uploads/');
                $data['license_img'] = $image;
            }

            $data['user_id'] = (Auth::user())? Auth::user()->id : null;
            $data['status'] = 'pending';

            $car = Car::with('user.vendor')->findOrFail($data['car_id']);

            if(empty($car)){
                return $this->errorResponse('اختيار غير صحيح للسيارة');
            }

            $data['vendor_user_id'] = $car->user_id;
            $data['car_details'] = json_encode($car);

            $tanant = Tanant::create($data);
            $tanant['car_details'] =json_decode($tanant['car_details']);
            return $this->successResponse('تم إضافة الطلب بنجاح', $tanant);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
