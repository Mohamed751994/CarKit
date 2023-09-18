<?php

namespace App\Http\Controllers\VendorControllers;

use App\Http\Requests\VendorDetailsRequest;
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

class DashboardController extends Controller
{
    use MainTrait;

    public function update_vendor_details(VendorDetailsRequest $request)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $image = $this->uploadFile($request,'image', 'uploads/');
                $data['image'] = $image;
            }
            $vendor = Vendor::where('user_id',$this->user_id())->update($data);
            return $this->successResponse('تم تعديل بيانات المعرض بنجاح', $vendor);
        } catch (\Throwable $th) {
        return $this->errorResponse($th->getMessage());
        }
    }

    public function get_vendor_cars_reservation()
    {
        try {
            $reservations = Tanant::latest()->where('vendor_user_id',$this->user_id())->get();

            foreach ($reservations as $key => $reservation) {
                $reservation['car_details'] = json_decode($reservation['car_details']);
            }

            return $this->successResponse('تم تعديل بيانات المعرض بنجاح', $reservations);
        } catch (\Throwable $th) {
        return $this->errorResponse($th->getMessage());
        }
    }




}
