<?php


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
