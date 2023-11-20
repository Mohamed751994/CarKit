<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorDataRequest;
use App\Models\ActivityLog;
use App\Models\Car;
use App\Models\Tanant;
use App\Models\User;
use App\Models\Vendor;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function Termwind\render;

class ReportController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::latest()->pluck('user_id', 'name');
        $users = User::whereType(0)->pluck('id', 'name');
        return view('admin_dashboard.reports.index' , compact('vendors','users'));
    }


    public function report(Request $request)
    {
        $user = User::find($request->userID);
        if(!$user) {
            $view = view('admin_dashboard.includes.no_data')->render();
            return response()->json(['success'=>false, 'report' =>$view]);
        }
        $userType = ($user->type == 'vendor') ? 'vendor_user_id' : 'user_id';
        $cars = ($user->type == 'vendor') ? Car::where('user_id',$user->id)->count() : 0;
        $pending = getMoneyAndCountOfVendor($user, 'pending',$userType);
        $approved = getMoneyAndCountOfVendor($user, 'approved',$userType);
        $cancelled = getMoneyAndCountOfVendor($user, 'cancelled',$userType);
        $rejected = getMoneyAndCountOfVendor($user, 'rejected',$userType);
        $view = view('admin_dashboard.reports.show', compact('user','cars','pending','approved', 'cancelled','rejected'))->render();
        return response()->json(['success'=>true, 'report' =>$view]);
    }



}
