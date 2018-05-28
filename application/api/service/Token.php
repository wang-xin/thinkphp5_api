<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/19
 * Time: 15:39
 */

namespace app\api\service;

use app\lib\exception\TokenException;
use app\lib\helper\Str;
use think\Cache;
use think\Config;
use think\Exception;
use think\Request;

class Token
{
    public static function generateToken()
    {
        $randChar = Str::generateRandChar(32);

        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];

        $tokenSalt = Config::get('secure.token_salt');

        return md5($randChar . $timestamp . $tokenSalt);
    }

    /**
     * getCurrentTokenVar
     * @auth King
     * @param $var
     *
     * @return mixed
     * @throws Exception
     * @throws TokenException
     */
    public static function getCurrentTokenVar($var)
    {
        $token = Request::instance()->header('token');
        $vars = Cache::get($token);
        if (!$vars) {
            throw new TokenException();
        }

        if (!is_array($vars)) {
            $vars = json_decode($vars, true);
        }

        if (array_key_exists($var, $vars)) {
            return $vars[$var];
        } else {
            throw new Exception('尝试获取的Token变量并不存在');
        }
    }

    /**
     * getCurrentUid
     * @auth King
     * @return mixed
     * @throws Exception
     * @throws TokenException
     */
    public static function getCurrentUid()
    {
        $uid = self::getCurrentTokenVar('uid');

        return $uid;
    }
}