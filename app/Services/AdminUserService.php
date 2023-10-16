<?php

namespace App\Services;

use App\Models\User;
use App\Traits\MainTrait;

class AdminUserService
{
    use MainTrait;
    public function index()
    {
        return User::whereType(0)->latest()->paginate($this->paginate);
    }
    public function store($request)
    {
        $data = $request->validated();
        return User::create($data);
    }

    public function update($request,$user)
    {
        $data = $request->validated();
        return $user->update($data);
    }

    public function destroy($user)
    {
        return $user->delete();
    }

    public function password($request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();
        return $user->update($data);
    }


}
