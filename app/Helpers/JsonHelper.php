<?php

namespace App\Helpers;

class JsonHelper
{
    public static function getJsonMetaValues($request)
    {
        return $request->get('_meta');
    }

    public static function getJsonDataValues($request)
    {
        return $request->get('_data');
    }

    public static function getJsonValues($parameter)
    {
        if (is_string($parameter) && is_array(json_decode($parameter, true)) ? true : false) {
            return json_decode($parameter);
        }
        return json_decode($parameter);
    }
}
