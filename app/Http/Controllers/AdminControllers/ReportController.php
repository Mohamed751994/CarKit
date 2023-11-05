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
        if($user->type == 'vendor')
        {
            //Vendor
            $cars = Car::where('user_id',$user->id)->count();
            $pending = getMoneyAndCountOfVendor($user, 'pending','vendor_user_id');
            $approved = getMoneyAndCountOfVendor($user, 'approved','vendor_user_id');
            $rejected = getMoneyAndCountOfVendor($user, 'rejected','vendor_user_id');
        }
        else
        {
            //User
            $cars = 0;
            $pending = getMoneyAndCountOfVendor($user, 'pending','user_id');
            $approved = getMoneyAndCountOfVendor($user, 'approved','user_id');
            $rejected = getMoneyAndCountOfVendor($user, 'rejected','user_id');
        }
        $view = view('admin_dashboard.reports.show', compact('user','cars','pending','approved','rejected'))->render();
        return response()->json(['success'=>true, 'report' =>$view]);
    }



}
