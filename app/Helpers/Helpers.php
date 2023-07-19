<?php

use App\Helpers\JsonHelper;

if (!function_exists('getJsonMetaValues')) {
    function getJsonMetaValues($request)
    {
        return JsonHelper::getJsonMetaValues($request);
    }
}

if (!function_exists('getJsonDataValues')) {
    function getJsonDataValues($request)
    {
        return JsonHelper::getJsonDataValues($request);
    }
}
