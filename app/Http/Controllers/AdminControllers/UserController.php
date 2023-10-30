<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserDataRequest;
use App\Models\User;
use App\Services\AdminUserService;
use App\Traits\MainTrait;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    use MainTrait;


    protected $userService;

    public function __construct(AdminUserService $adminUserService)
    {
        $this->userService = $adminUserService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = $this->userService->index();
        return view('admin_dashboard.users.index' , compact('content'));
    }

    public function create()
    {
        return view('admin_dashboard.users.create');
    }

    public function store(UserDataRequest $request)
    {
        $this->userService->store($request);
        Session::flash('success', $this->insertMsg);
        return redirect()->back();
    }


    public function show(User $user)
    {
        $content =  $user;
        return view('admin_dashboard.users.show', compact('content'));
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
        $this->userService->update($request,$user);
        Session::flash('success', $this->updateMsg);
        return redirect()->back();
    }

    public function update_password(ChangePasswordRequest $request, $id)
    {
        $this->userService->password($request,$id);
        Session::flash('success', $this->updateMsg);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->userService->destroy($user);
        Session::flash('success', $this->deleteMsg);
        return redirect()->back();
    }

}
