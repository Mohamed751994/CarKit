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
        $vendors = Vendor::count();
        $users = User::whereType(0)->count();
        $cars = Car::with('user.vendor')->vendorStatus()->count();
        $reservations = Tanant::count();
        $latest_10_orders = Tanant::latest()->limit(10)->get();

        $allCounts = ['vendors' ,'users','cars','reservations','latest_10_orders'];
        return view('admin_dashboard.dashboard', compact($allCounts));
    }

}
