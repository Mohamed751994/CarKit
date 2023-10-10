<?php

namespace App\Http\Controllers\VendorControllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\User;
use App\Models\Vendor;
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

    public function create_new_car(CarRequest $request)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $image = $this->uploadFile($request, 'image', 'uploads/');
                $data['image'] = $image;
            }
            $data['user_id'] = $this->user_id();
            $data['additions'] =  isset($data['additions']) ? implode(",", $data['additions']) : null;
            $data['features'] =  isset($data['features']) ? implode(",", $data['features']) : null;
            $car = Car::create($data);
            return $this->successResponse('تم إضافة السيارة بنجاح', [$car]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function get_vendor_cars()
    {
        try {

            $user_id = $this->user_id();
            $cars = Car::where('user_id', $user_id)->latest()->get();

            $vendor_name = Auth::user()->name;
            return $this->successResponse("سيارات التاجر ($vendor_name)", $cars);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

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

            $car = Car::with('vendor')->find($id);

            return $this->successResponse('بيانات السيارة', $car);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
