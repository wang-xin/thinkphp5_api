<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/19
 * Time: 15:36
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\service\UserToken;
use app\api\validate\Code;

class Token extends BaseController
{
    /**
     * getToken
     * @auth King
     * @param string $code
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \app\lib\exception\ParameterException
     * @throws \app\lib\exception\WeChatException
     * @throws \think\Exception
     */
    public function getToken($code = '')
    {
        (new Code())->goCheck();

        $ut = new UserToken();
        $token = $ut->get($code);

        return ['token' => $token];
    }
}