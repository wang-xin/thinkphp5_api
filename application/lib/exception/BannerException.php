<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/16
 * Time: 16:28
 */

namespace app\lib\exception;


class BannerException extends BaseException
{
    public $code = 404;
    public $errorCode = 40000;
    public $message = '请求banner不存在';
}