<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/16
 * Time: 16:27
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $errorCode = 3000;
    public $message = '指定主题不存在，请检查主题ID';
}