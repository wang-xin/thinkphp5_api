<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/19
 * Time: 15:39
 */

namespace app\api\service;

use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
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

        $timestamp = Request::instance()->time(true);

        $tokenSalt = Config::get('secure.token_salt');

        return md5($randChar . $timestamp . $tokenSalt);
    }

    /**
     * getCurrentTokenVar
     * @auth King
     *
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

    /**
     * 验证权限大于等于用户权限
     * needPrimaryScope
     * @auth King
     * @return bool
     * @throws Exception
     * @throws ForbiddenException
     * @throws TokenException
     */
    public static function needPrimaryScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if (!$scope) {
            throw new TokenException();
        }

        if ($scope >= ScopeEnum::USER) {
            return true;
        }

        throw new ForbiddenException();
    }

    /**
     * 验证用户权限
     * @auth King
     * @return bool
     * @throws Exception
     * @throws ForbiddenException
     * @throws TokenException
     */
    public static function needExclusiveScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if (!$scope) {
            throw new TokenException();
        }

        if ($scope == ScopeEnum::USER) {
            return true;
        }

        throw new ForbiddenException();
    }

    /**
     * 验证管理员权限
     * needSuperScope
     * @auth King
     * @return bool
     * @throws Exception
     * @throws ForbiddenException
     * @throws TokenException
     */
    public static function needSuperScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if (!$scope) {
            throw new TokenException();
        }

        if ($scope == ScopeEnum::SUPER) {
            return true;
        }

        throw new ForbiddenException();
    }
}