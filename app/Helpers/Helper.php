<?php


use App\Models\ActivityLog;
use App\Models\Tanant;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

if (!function_exists('getActiveLink'))
{
    function getActiveLink($segment)
    {
        return \Request::segment(2) == $segment;
    }
}
if (!function_exists('assetURLFile')) {
    function assetURLFile($filename)
    {
        return asset('/uploads/'. $filename);
    }
}

if (!function_exists('dateDiffInDays')) {
    function dateDiffInDays($date1, $date2)
    {
        $diff = strtotime($date2) - strtotime($date1);
        return abs(round($diff / 86400)) +1;
    }
}

if (!function_exists('tanantsStatusTypeCount')) {
    function tanantsStatusTypeCount($type)
    {
        return \App\Models\Tanant::whereStatus($type)->count();
    }
}
if (!function_exists('getSettings')) {
    function getSettings($col)
    {
        return \App\Models\Setting::first()?->$col;
    }
}
//activityLog
if (!function_exists('activityLog')) {
    function activityLog($method, $model, $item_json)
    {
        $data = [
            'user_id' =>Auth::check() ? (auth()->user()->id) : 0,
            'user_json' =>Auth::check() ? json_encode(auth()->user()) : null,
            'ip' =>\request()->ip(),
            'method' =>$method,
            'model' =>$model,
            'item_json' =>json_encode($item_json),
            'user_agent' =>\Request::header('user-agent') ?? '',
        ];
        ActivityLog::create($data);
    }
}
if (!function_exists('getMoneyAndCountOfVendor')) {
    function getMoneyAndCountOfVendor($user,$status, $userType)
    {
        $data = Tanant::where($userType,$user->id)->whereStatus($status);
        $money_data = $data->sum('total_amount_after_discount');
        $count_data = $data->count();
        return ['count' =>$count_data,'money' =>$money_data];
    }
}
