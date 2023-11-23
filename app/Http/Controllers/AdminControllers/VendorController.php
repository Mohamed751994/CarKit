<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorDataRequest;
use App\Models\User;
use App\Models\Vendor;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VendorController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = User::with('vendor')->whereType(2);
        if(request('live_search') && request('live_search') != '')
        {
            $content =$content->where('email', 'LIKE', '%'.request('live_search').'%');
        }
        $content = $content->latest()->paginate($this->paginate);
        return view('admin_dashboard.vendors.index' , compact('content'));
    }

    public function create()
    {
        return view('admin_dashboard.vendors.create');
    }

    public function store(VendorDataRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['type'] = 2;
            $user = User::create($data);
            if($user)
            {
                $this->saveVendorDetails($request,$user,$data);
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
    public function edit(User $vendor)
    {
        $content =  $vendor;
        return view('admin_dashboard.vendors.edit', compact('content'));
    }


    public function show(User $vendor)
    {
        $content =  User::with(['vendor', 'cars'])->findOrFail($vendor->id);
        return view('admin_dashboard.vendors.show', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendorDataRequest $request, User $vendor)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $vendor->update($data);
            if ($request->hasFile('image')) {
                $image = $this->uploadFile($request, 'image', 'uploads/');
                $data['image'] = $image;
            }
            isset($data['status']) ? $data['status']=1 : $data['status'] = 0;
            $vendor->update(['name'=>$data['name']]);
            $vendor->vendor()->update(Arr::except($data, ['email', 'password','phone','type']));
            DB::commit();
            Session::flash('success', $this->updateMsg);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Error:' .$e);
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $vendor)
    {
        $vendor->vendor()->delete();
        $vendor->delete();
        Session::flash('success', $this->deleteMsg);
        return redirect()->back();
    }



    //save vendor details
    public function saveVendorDetails($request,$user,$data)
    {
        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request, 'image', 'uploads/');
            $data['image'] = $image;
        }
        isset($data['status']) ? $data['status']=1 : $data['status'] = 0;
        $user->vendor()->create(Arr::except($data, ['email', 'password','phone','type']));
    }


    //changeStatus
    public function quickChange(Request $request)
    {
        return $this->quickChangeTrait($request);
    }



}
