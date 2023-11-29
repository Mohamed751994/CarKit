<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Tanant;
use App\Models\CarsModel;
use App\Models\User;
use App\Models\Vendor;
use App\Traits\MainTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InvoiceController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $content = Tanant::whereStatus('approved');
        if($request->vendor && !is_null($request->vendor))
        {
            $content = $content->where('vendor_user_id', $request->vendor);
        }
        $content = $content
            ->where('from_date', '<=',date('Y-m-d', strtotime(Carbon::tomorrow())))
            ->orderBy('from_date','desc')
            ->paginate($this->paginate);
        $vendors = Vendor::pluck('name','user_id');
        return view('admin_dashboard.invoices.index' , compact('content','vendors'));
    }


    public function show(Tanant $invoice)
    {
        $content = $invoice;
        return view('admin_dashboard.invoices.show' , compact('content'));
    }


}
