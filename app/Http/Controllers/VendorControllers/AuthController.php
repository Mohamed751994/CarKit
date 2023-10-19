<?php

namespace App\Http\Controllers\VendorControllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Vendor;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use MainTrait;

    public function register(RegisterRequest $request)
    {
        try {
            $data = $request->validated();
            if($data['type'] == 'vendor')
            {
                $data['type'] = 2;
            }
            elseif($data['type'] == 'user')
            {
                $data['type'] = 0;
            }
            else
            {
                return $this->errorResponse(' نوع الحساب مطلوب ');
            }

            $user = User::create($data);
            $this->save_new_vendor_details($user);
            $vendorDetails = User::with('vendor')->whereId($user->id)->first();
            return $this->successResponse(
                'تم إنشاء الحساب بنجاح',
                ['user' => $vendorDetails, 'access_token' =>$user->createToken("REGISTER TOKEN")->plainTextToken]
            );
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }


    public function login(LoginRequest $request)
    {
        try {
            $data = $request->validated();
            $input_email_or_phone = filter_var($data['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
            if(Auth::attempt([$input_email_or_phone => $request->email, 'password' => $request->password])){
                $vendorDetails = User::with('vendor')->whereId(auth()->user()->id)->first();
//                if(!$vendorDetails->vendor?->status)
//                {
//                    return $this->errorResponse('هذا الحساب غير مفعل , تواصل مع خدمة العملاء', 403);
//                }
                return $this->successResponse(
                    'تم تسجيل الدخول بنجاح',
                    ['access_token' =>auth()->user()->createToken("LOGIN TOKEN")->plainTextToken , 'user' => $vendorDetails]
                );
            }
            return $this->errorResponse('بيانات تسجيل الدخول غير صحيحة', 403);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->successResponse('تم تسجيل الخروج بنجاح');
    }


    public function vendor()
    {
        $vendor = User::with('vendor')->whereId($this->user_id())->first();
        if(!$vendor)
        {
            return $this->errorResponse('التاجر غير موجود');
        }
        return $this->successResponse('بيانات التاجر', $vendor);
    }




}
