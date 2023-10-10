<?php

namespace App\Http\Controllers\AdminControllers;
use App\Models\Category;
use App\Models\Course;
use App\Models\Material;
use App\Models\User;
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
        return view('admin_dashboard.dashboard');
    }

}
