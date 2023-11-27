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
        if(request('live_search') && request('live_search') != '')
        {
            $content =$content->where('model', 'LIKE', '%'.request('live_search').'%');
        }
        $content = $content->orderBy('reservations_count', 'desc')->paginate($this->paginate);
        $vendors = Vendor::pluck('name','user_id');
        return view('admin_dashboard.cars.index', compact('content','vendors'));
    }


    public function show(Car $car)
    {
        $content =  $car;
        $content->comfort_additions = ($content->comfort_additions) ? $this->explodeData($content->comfort_additions) : [];
        $content->sound_additions =  ($content->sound_additions) ? $this->explodeData($content->sound_additions): [];
        $content->safety_additions =  ($content->safety_additions) ? $this->explodeData($content->safety_additions): [];
        return view('admin_dashboard.cars.show', compact('content'));
    }

    public function destroy(Car $car)
    {
        $car->delete();
        Session::flash('success', $this->deleteMsg);
        return redirect()->back();
    }


}
