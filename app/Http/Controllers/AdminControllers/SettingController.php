<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\SettingRequest;
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
    public function update(SettingRequest $request, Setting $setting)
    {
        try {
            $data = $request->validated();
            if($request->file('website_logo'))
            {
               $image = $this->uploadFile($request, 'website_logo', 'uploads/');
                $data['website_logo'] = $image;
            }
            $setting->update($data);
            Session::flash('success', $this->updateMsg);
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('error', 'Error:' .$e);
            return redirect()->back();
        }
    }


}
