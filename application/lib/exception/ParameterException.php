<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/2
 * Time: 11:14
 */

namespace app\lib\exception;


/**
 * Class ParameterException
 * 通用参数类异常错误
 * @package app\lib\exception
 */
class ParameterException extends BaseException
{
    public $code = 400;
    public $errorCode = 10000;
    public $message = "invalid parameters";
}