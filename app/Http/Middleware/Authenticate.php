<?php

namespace App\Http\Middleware;

use App\Traits\MainTrait;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    use MainTrait;
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if( $request->is('api/*')){
            return $request->expectsJson() ? null : $this->errorResponse('يجب تسجيل الدخول أولاً');
        }else{
            return $request->expectsJson() ? null : '/';
        }
    }
}
