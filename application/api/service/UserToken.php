<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/19
 * Time: 16:41
 */

namespace app\api\service;


use app\api\model\User;
use app\lib\exception\WeChatException;
use think\Config;
use think\Exception;

class UserToken
{
    /**
     * get
     * @auth King
     *
     * @param $code
     *
     * @return string
     * @throws Exception
     * @throws WeChatException
     */
    public function get($code)
    {
        $appId = Config::get('wx.app_id');
        $appSecret = Config::get('wx.app_secret');

        $loginUrl = sprintf(Config::get('login_url'), $appId, $appSecret, $code);

        $result = curl_get($loginUrl);
        if (empty($result)) {
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        }

        $wxResult = json_decode($result, true);
        if (array_key_exists('errcode', $wxResult)) {
            $this->processLoginError($wxResult);
        } else {
            return $this->grantToken($wxResult);
        }
    }

    /**
     * processLoginError
     * @auth King
     *
     * @param $wxResult
     *
     * @throws WeChatException
     */
    private function processLoginError($wxResult)
    {
        throw new WeChatException([
            'error_code' => $wxResult['errcode'],
            'message'    => $wxResult['errmsg'],
        ]);
    }

    /**
     * grantToken
     * @auth King
     *
     * @param $wxResult
     *
     * @return string
     */
    private function grantToken($wxResult)
    {
        $openid = $wxResult['openid'];

        $user = User::getUserByOpenid($openid);
        if (!$user) {
            // 新用户，创建一个用户
            $uid = $this->newUser($openid);
        } else {
            $uid = $user->id;
        }

        $token = '';

        return $token;
    }

    /**
     * newUser
     * @auth King
     *
     * @param $openid
     *
     * @return mixed
     */
    private function newUser($openid)
    {
        $user = User::create(['openid' => $openid]);

        return $user->id;
    }
}