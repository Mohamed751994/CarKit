<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\CarsBrand;
use App\Models\CarsModel;
use App\Models\Setting;
use App\Models\User;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = Setting::first() ?? '';
        return view('admin_dashboard.settings.index' , compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        try {
            $setting->update($request->except('_token'));
            Session::flash('success', $this->updateMsg);
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('error', 'Error:' .$e);
            return redirect()->back();
        }
    }


}
