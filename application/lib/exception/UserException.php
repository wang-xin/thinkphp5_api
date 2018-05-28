<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/5/28
 * Time: 15:01
 */

namespace app\lib\exception;

class UserException extends BannerException
{
    public $code = 404;
    public $message = '用户不存在';
    public $errorCode = 60000;
}