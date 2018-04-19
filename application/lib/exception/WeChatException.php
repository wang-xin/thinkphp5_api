<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/19
 * Time: 17:06
 */

namespace app\lib\exception;

class WeChatException extends BaseException
{
    public $code = 400;
    public $message = 'wechat unknown error';
    public $errorCode = 999;
}