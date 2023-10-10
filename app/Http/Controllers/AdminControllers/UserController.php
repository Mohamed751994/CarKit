<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserDataRequest;
use App\Models\User;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = User::whereType('user')->latest()->paginate($this->paginate);
        return view('admin_dashboard.users.index' , compact('content'));
    }

    public function create()
    {
        return view('admin_dashboard.users.create');
    }

    public function store(UserDataRequest $request)
    {
        $data = $request->validated();
        User::create($data);
        Session::flash('success', $this->insertMsg);
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $content =  $user;
        return view('admin_dashboard.users.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserDataRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        Session::flash('success', $this->updateMsg);
        return redirect()->back();
    }

    public function update_password(ChangePasswordRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();
        $user->update($data);
        Session::flash('success', $this->updateMsg);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        Session::flash('success', $this->deleteMsg);
        return redirect()->back();
    }

}
