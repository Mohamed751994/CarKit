<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Tanant;
use App\Models\CarsModel;
use App\Models\User;
use App\Traits\MainTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TanantController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = Tanant::latest()->paginate($this->paginate);
        return view('admin_dashboard.tanants.index' , compact('content'));
    }


    public function show(Tanant $tanant)
    {
        $content = $tanant;
        return view('admin_dashboard.tanants.show' , compact('content'));
    }


}
