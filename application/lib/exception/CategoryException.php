<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/19
 * Time: 15:11
 */

namespace app\lib\exception;

class CategoryException extends BaseException
{
    public $code = 404;
    public $message = '指定类目不存在，请检查商品ID';
    public $errorCode = 20000;
}