<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Requests\LoginRequest;
use App\Traits\MainTrait;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    use MainTrait;

    //login page
    public function login_page()
    {
        if(Auth::check())
        {
            return redirect()->route('admin.dashboard');
        }
        return view('admin_dashboard.login');
    }

    //login
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        if($user && $user->type != 'admin')
        {
            Session::flash('error', 'عفواً - ليس لديك صلاحية الدخول');
            return redirect()->back();
        }

        if (!Auth::attempt($data)) {
            Session::flash('error', ' البريد الإلكتروني أو كلمة المرور غير صحيحة');
            return redirect()->back()->withInput();
        }
        Session::flash('success', 'تم تسجيل الدخول بنجاح');
        return redirect()->route('admin.dashboard');
    }

}


