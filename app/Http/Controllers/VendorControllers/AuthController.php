<?php

namespace App\Http\Controllers\VendorControllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Reset;
use App\Models\User;
use App\Models\Vendor;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use MainTrait;

    public function register(RegisterRequest $request)
    {
        try {
            $data = $request->validated();
            if(isset($data['type']) && $data['type'] == 'vendor')
            {
                $data['type'] = 2;
            }
            elseif(isset($data['type']) && $data['type'] == 'user')
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


    public function forget_password(ForgetPasswordRequest $request)
    {
        try {
            $data = $request->validated();
            //Send Email Here
            $user = User::whereEmail($data['email'])->first();
            $encrypt = Crypt::encryptString($user->id);
            $link =  getSettings('website_url').'/reset-password/'.$encrypt;
            $html = view('emails.forget_password', compact('user', 'link'))->render();
            $this->sendEmail($user->email,'CarKits',$html, 'CarKits | Resetting Password');
            return $this->successResponse('تم إرسال الرابط علي البريد الإلكتروني', []);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function reset_password(ChangePasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $user = User::whereId(Crypt::decryptString($data['encrypt_user_id']))->first();
            if(Reset::whereEmail($user->email)->whereToken($data['encrypt_user_id'])->exists())
            {
                return $this->errorResponse('تم تغيير كلمة المرور من خلال هذا الرابط من قبل');
            }
            if ($user) {
                $user->update(['password' => $data['password']]);
                Reset::create(['email' =>$user->email, 'token' =>$data['encrypt_user_id']]);
                DB::commit();
                return $this->successResponse('تم تغيير كلمة المرور بنجاح', []);
            } else {
                return $this->errorResponse('هناك خطأ ما');
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return $this->errorResponse($th->getMessage());
        }
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
