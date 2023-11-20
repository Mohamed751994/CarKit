<?php

namespace App\Http\Controllers\API\Auth;

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
use Illuminate\Support\Arr;
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
        DB::beginTransaction();
        try {
                $data = $request->validated();
                $data['type'] = ($data['type'] == 'vendor') ? 2 : 0;

                //Save User Table
                $user = User::create($data);

                //Save vendor if type vendor
                if($user && $user->type == 'vendor')
                {
                    $this->save_new_vendor_details($user);
                }

                //Send Mail to Vendor
                $link =  getSettings('website_url').'/verification-email/'.Crypt::encryptString($user->id);
                $html = view('emails.verification_email', compact('user', 'link'))->render();
                $this->sendEmail($user->email,'كاركيتس',$html, "كاركيتس | التحقق من البريد الإلكتروني");

                DB::commit();
                return $this->successResponse(
                    'تم إرسال رابط التحقق علي بريدك الإلكتروني'
                );


        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorResponse($th->getMessage());
        }
    }


    public function login(LoginRequest $request)
    {
        try {
            $data = $request->validated();
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $vendorDetails = User::with('vendor')->whereId($this->user_id())->first();
                if(is_null(auth()->user()->email_verified_at))
                {
                    return $this->errorResponse('الحساب غير مفعل , برجاء التحقق من البريد الإلكتروني', 403);
                }
                return $this->successResponse(
                    'تم تسجيل الدخول بنجاح',
                    ['access_token' =>auth()->user()->createToken("LOGIN TOKEN")->plainTextToken , 'user' => $vendorDetails]
                );
            }
            return $this->errorResponse('بيانات تسجيل الدخول غير صحيحة ', 403);

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
            if (!$user) {
                return $this->errorResponse('البريد الإلكتروني غير موجود');
            }
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

    //Get Vendor Details
    public function vendor()
    {
        $vendor = User::with('vendor')->whereId($this->user_id())->first();
        if(!$vendor)
        {
            return $this->errorResponse('التاجر غير موجود');
        }
        return $this->successResponse('بيانات التاجر', $vendor);
    }


    //Verification Email
    public function verification_email($id)
    {
        $user = User::find(Crypt::decryptString($id));
        if($user && is_null($user->email_verified_at))
        {
            $user->update(['email_verified_at' =>date('Y-m-d H:i:s')]);
            $message = 'تم التحقق من البريد الإلكتروني بنجاح يمكنك تسجيل الدخول الآن';
        }
        else
        {
           $message = 'تم التحقق من البريد الإلكتروني بالفعل يمكنك تسجيل الدخول الآن';
        }
        return $this->successResponse($message);
    }


}
