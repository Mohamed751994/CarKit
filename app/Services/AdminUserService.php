<?php

namespace App\Services;

use App\Models\User;
use App\Traits\MainTrait;

class AdminUserService
{
    use MainTrait;
    public function index()
    {
        $content = User::whereType(0)->latest();
        if(request('live_search') && request('live_search') != '')
        {
            $content =$content->where('email', 'LIKE', '%'.request('live_search').'%');
        }
        return $content =$content->paginate($this->paginate);
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
