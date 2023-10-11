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
