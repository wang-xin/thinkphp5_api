<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/19
 * Time: 15:39
 */

namespace app\api\service;

use app\lib\helper\Str;
use think\Config;

class Token
{
    public static function generateToken()
    {
        $randChar = Str::generateRandChar(32);

        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];

        $tokenSalt = Config::get('secure.token_salt');

        return md5($randChar . $timestamp . $tokenSalt);
    }
}