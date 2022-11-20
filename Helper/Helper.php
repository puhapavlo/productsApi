<?php

namespace Pablo\ApiProduct\Helper;

/**
 * Class with help functions.
 */
class Helper
{
    public static function addQuotesToArrayValue($array)
    {
        foreach ($array as &$value) {
            $value = "'" . $value . "'";
        }
        return $array;
    }

    public static function placeholder($string, $array)
    {
        foreach ($array as $key => $value) {
            $string = str_replace($key, $value, $string);
        }
        return $string;
    }
}
