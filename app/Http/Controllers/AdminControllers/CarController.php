<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorDataRequest;
use App\Models\Car;
use App\Models\User;
use App\Models\Vendor;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CarController extends Controller
{
    use MainTrait;


    public function index(Request $request)
    {
        $content = Car::with(['user.vendor', 'brands'])->withCount('reservations');
        if($request->vendor && !is_null($request->vendor))
        {
            $content = $content->where('user_id', $request->vendor);
        }
        $content = $content->paginate($this->paginate);
        $vendors = Vendor::pluck('name','user_id');
        return view('admin_dashboard.cars.index', compact('content','vendors'));
    }


    public function show(Car $car)
    {
        $content =  $car;
        return view('admin_dashboard.cars.show', compact('content'));
    }

    public function destroy(Car $car)
    {
        $car->delete();
        Session::flash('success', $this->deleteMsg);
        return redirect()->back();
    }


}
