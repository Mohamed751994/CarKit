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

class ReportController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = User::with('vendor')->whereType(2)->latest()->get();
        $users = User::whereType(0)->latest()->get();
        return view('admin_dashboard.reports.index' , compact('vendors','users'));
    }


    public function show(ActivityLog $report)
    {
        $content =  $report;
        return view('admin_dashboard.reports.show', compact('content'));
    }



}
