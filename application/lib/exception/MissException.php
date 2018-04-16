<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/2
 * Time: 16:01
 */

namespace app\lib\exception;


class MissException extends BaseException
{
    public $code = 404;
    public $message = 'your required resource are not found';
    public $errorCode = 10001;
}