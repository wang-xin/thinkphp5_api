<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/19
 * Time: 16:41
 */

namespace app\api\service;


use app\api\model\User;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use GuzzleHttp\Client;
use think\Cache;
use think\Config;
use think\Exception;

class UserToken extends Token
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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($code)
    {
        $appId = Config::get('wx.app_id');
        $appSecret = Config::get('wx.app_secret');

        $loginUrl = sprintf(Config::get('wx.login_url'), $appId, $appSecret, $code);

        $client = new Client([
            'verify' => false
        ]);
        $response = $client->request('GET', $loginUrl);
        $result = $response->getBody();

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
     * @throws TokenException
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

        $cacheValue = $this->prepareCacheValue($wxResult, $uid);

        $token = $this->saveCache($cacheValue);

        return $token;
    }

    /**
     * prepareCacheValue
     * @auth King
     *
     * @param $wxResult
     * @param $uid
     *
     * @return mixed
     */
    private function prepareCacheValue($wxResult, $uid)
    {
        $cacheValue = $wxResult;
        $cacheValue['uid'] = $uid;
        $cacheValue['scope'] = 16;

        return $cacheValue;
    }

    /**
     * saveCache
     * @auth King
     *
     * @param $cacheValue
     *
     * @return string
     * @throws TokenException
     */
    private function saveCache($cacheValue)
    {
        $key = self::generateToken();
        $value = json_encode($cacheValue);
        $expire_in = Config::get('setting.token_expire_in');

        $result = Cache::set($key, $value, $expire_in);
        if (!$result) {
            throw new TokenException([
                'message'   => '服务器缓存异常',
                'errorCode' => 10005,
            ]);
        }

        return $key;
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