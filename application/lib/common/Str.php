<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/5/11
 * Time: 14:20
 */

namespace app\lib\common;


class Str
{
    public static function generateRandChar($length = 16)
    {
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol) - 1;

        for ($i = 0; $i < $length; $i++) {
            $str .= $strPol[rand(0, $max)];
        }

        return $str;
    }
}