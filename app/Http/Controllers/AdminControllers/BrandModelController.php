<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\CarsBrand;
use App\Models\CarsModel;
use App\Models\User;
use App\Traits\MainTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BrandModelController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = CarsBrand::with('models')->paginate($this->paginate);
        return view('admin_dashboard.brands.index' , compact('content'));
    }

    public function create()
    {
        return view('admin_dashboard.brands.create');
    }

    public function store(BrandRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $brand = CarsBrand::create($data);
            if(isset($data['model_name']))
            {
                foreach ($data['model_name'] as $key => $model)
                {
                    CarsModel::create(['brand_id'=>$brand->id, 'model_name'=>$model]);
                }
            }
            DB::commit();
            Session::flash('success', $this->insertMsg);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Error:' .$e);
            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarsBrand $brand)
    {
        $content =  $brand;
        return view('admin_dashboard.brands.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, CarsBrand $brand)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $brand->update($data);
             foreach ($data['model_name'] as $key => $model)
                {
                    if(!is_null($model))
                    {
                        CarsModel::create(['brand_id'=>$brand->id, 'model_name'=>$model]);
                    }
                }

            DB::commit();
            Session::flash('success', $this->updateMsg);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Error:' .$e);
            return redirect()->back();
        }
    }

    public function destroy(CarsBrand $brand)
    {
        $brand->models()->delete();
        $brand->delete();
        Session::flash('success', $this->deleteMsg);
        return redirect()->back();
    }

    //destroyModel
    public function modelDestroy($id)
    {
        CarsModel::whereId($id)->delete();
        Session::flash('success', $this->deleteMsg);
        return redirect()->back();
    }


}
