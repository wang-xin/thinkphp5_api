<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/5/11
 * Time: 14:27
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $message = 'Token已过期或无效Token';
    public $errorCode = 10001;
}