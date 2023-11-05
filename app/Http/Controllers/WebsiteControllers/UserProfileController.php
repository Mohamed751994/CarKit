<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Requests\CarRequest;
use App\Http\Requests\CarReservationRequest;


use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RatingRequest;
use App\Models\Car;
use App\Models\CarsBrand;
use App\Models\CarsModel;
use App\Models\Rating;
use App\Models\Reset;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Tanant;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{
    use MainTrait;

    //my profile
    public function profile()
    {
        try {
            $user = auth()->user();
            return $this->successResponse('حجوزاتي ', $user);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function user_change_password(ChangePasswordRequest $request)
    {
        try {
            $data = $request->validated();
            auth()->user()->update(['password' => $data['password']]);
            return $this->successResponse('تم تغيير كلمة المرور بنجاح', []);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    //my reservations
    public function my_reservations()
    {
        try {
            $reservations = Tanant::where('user_id', $this->user_id())->latest()->get();
            foreach ($reservations as $key => $reservation) {
                $reservation['car_details'] = json_decode($reservation['car_details']);
            }
            return $this->successResponse('حجوزاتي ', $reservations);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
    public function my_reservations_pagination()
    {
        try {
            $reservations = Tanant::where('user_id', $this->user_id())->latest()->paginate($this->paginate);
            foreach ($reservations as $key => $reservation) {
                $reservation['car_details'] = json_decode($reservation['car_details']);
            }
            return $this->successResponse('حجوزاتي ', $reservations);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
    //my single reserve
    public function my_single_reserve($id)
    {
        try {
            $reservation = Tanant::where('user_id', $this->user_id())->whereId($id)->first();
            if(!$reservation)
            {
                return $this->errorResponse('الحجز غير موجود');
            }
            $reservation['car_details'] = json_decode($reservation['car_details']);
            return $this->successResponse('حجوزاتي ', $reservation);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }


    //Rating
    public function user_rate(RatingRequest $request)
    {
        try {
            $data =$request->validated();
            //Check if user rate this type before or not
            $check = Rating::where(['user_id' => $this->user_id(), 'type' => $data['type'], 'type_id'=>$data['type_id']])->first();
            if($check)
            {
                $check->update(['rate' =>$data['rate']]);
            }
            else
            {
                $data['user_id'] = $this->user_id();
                Rating::create($data);
            }
            return $this->successResponse('تم التقييم بنجاح', []);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

}
