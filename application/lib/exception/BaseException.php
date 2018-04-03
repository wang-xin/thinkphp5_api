<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/2
 * Time: 09:58
 */

namespace app\lib\exception;

use think\Exception;

class BaseException extends Exception
{
    /**
     * @var
     */
    public $code;

    /**
     * @var
     */
    public $msg;

    /**
     * @var
     */
    public $errorCode;

    public function __construct($params = [])
    {
        if (!is_array($params)) {
            return ;
        }

        if (array_key_exists('code', $params)) {
            $this->code = $params['code'];
        }

        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }

        if (array_key_exists('error_code', $params)) {
            $this->errorCode = $params['error_code'];
        }
    }
}
