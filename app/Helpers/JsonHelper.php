<?php

namespace App\Helpers;

class JsonHelper
{
    public static function getJsonMetaValues($request)
    {
        $parameter = $request->get('_meta');
        if (is_string($parameter) && is_array(json_decode($parameter, true)) ? true : false) {
            return json_decode($parameter);
        }
        return json_decode(json_encode($parameter));
    }

    public static function getJsonDataValues($request)
    {
        $parameter = $request->get('_data');
        if (is_string($parameter) && is_array(json_decode($parameter, true)) ? true : false) {
            return json_decode($parameter);
        }
        return json_decode(json_encode($parameter));
    }

    public static function getJsonValues($parameter)
    {
        if (is_string($parameter) && is_array(json_decode($parameter, true)) ? true : false) {
            return json_decode($parameter);
        }
        return json_decode($parameter);
    }
}
