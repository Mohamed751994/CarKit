<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorDataRequest;
use App\Models\ActivityLog;
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
        $userID =  $request->userID;
        return view('admin_dashboard.reports.show', compact('userID'))->render();
    }



}
