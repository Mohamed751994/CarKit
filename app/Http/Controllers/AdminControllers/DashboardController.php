<?php

namespace App\Http\Controllers\AdminControllers;
use App\Models\Car;
use App\Models\Category;
use App\Models\Course;
use App\Models\Material;
use App\Models\Tanant;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        //Stats
        $vendors = Vendor::count();
        $users = User::whereType(0)->count();
        $cars = Car::with('user.vendor')->active()->vendorStatus()->count();
        $reservations_pending = Tanant::whereStatus('pending')->count();
        $reservations_approved = Tanant::whereStatus('approved')->count();
        $reservations_rejected = Tanant::whereStatus('rejected')->count();
        $latest_10_orders = Tanant::latest()->limit(10)->get();

        //Most Reserve Cars
        $most_reserve_cars = Tanant::select('car_id', \DB::raw('COUNT(*) as `count`'), 'car_details')
            ->groupBy('car_id', 'car_details')
            ->orderBy('count', 'DESC')
            ->limit(6)
            ->get();

        //most vendors reserve
         $most_reserve_vendors = Tanant::with('vendor_user.vendor')->select('vendor_user_id', \DB::raw('COUNT(*) as `count`'))
            ->groupBy('vendor_user_id')
            ->orderBy('count', 'DESC')
            ->limit(6)
            ->get();
        $data = ['vendors' ,'users','cars','reservations_pending', 'reservations_rejected' , 'reservations_approved','most_reserve_cars','most_reserve_vendors','latest_10_orders'];
        return view('admin_dashboard.dashboard', compact($data));
    }

}
