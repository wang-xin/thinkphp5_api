<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/6/7
 * Time: 14:20
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $message = '权限不够';
    public $errorCode = 10001;
}