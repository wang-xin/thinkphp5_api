<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/2
 * Time: 09:53
 */

namespace app\lib\exception;

use think\Config;
use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandle extends Handle
{
    /**
     * @var int HTTP状态码
     */
    private $code;

    /**
     * @var string  错误信息
     */
    private $message;

    /**
     * @var int 错误码
     */
    private $errorCode;

    public function render(\Exception $e)
    {
        if ($e instanceof BaseException) {
            $this->code = $e->code;
            $this->message = $e->message;
            $this->errorCode = $e->errorCode;
        } else {
            if (Config::get('app_debug')) {
                return parent::render($e);
            }

            $this->code = 500;
            $this->message = '服务器内部错误';
            $this->errorCode = 999;

            $this->recordErrorLog($e);
        }

        $request = Request::instance();
        $result = [
            'error_code'  => $this->errorCode,
            'message'     => $this->message,
            'request_url' => $request->method() . ' ' . $request->url(),
        ];

        return json($result, $this->code);
    }

    private function recordErrorLog(\Exception $e)
    {
        Log::record($e->getMessage(), 'error');
    }
}