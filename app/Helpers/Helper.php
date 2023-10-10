<?php


if (!function_exists('getActiveLink'))
{
    function getActiveLink($segment)
    {
        return \Request::segment(2) == $segment;
    }
}
