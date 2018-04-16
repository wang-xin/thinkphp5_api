<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/16
 * Time: 17:02
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code = 404;
    public $errorCode = 20000;
    public $message = '指定商品不存在，请检查商品ID';
}