<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/5/28
 * Time: 15:07
 */

namespace app\lib\exception;

class SuccessMessageException extends BaseException
{
    public $code = 201;
    public $message = 'ok';
    public $errorCode = 0;
}