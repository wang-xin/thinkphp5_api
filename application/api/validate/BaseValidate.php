<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/2
 * Time: 11:06
 */

namespace app\api\validate;

use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    protected $params;

    /**
     * goCheck
     * @auth King
     * @return bool
     * @throws ParameterException
     */
    public function goCheck()
    {
        $request = Request::instance();
        $this->params = $request->param();
        $this->params['token'] = $request->header('token');

        if (!$this->batch()->check($this->params)) {
            throw new ParameterException([
                'message' => is_array($this->error) ? implode(';', $this->error) : $this->error,
                // 'message' => $this->error,
            ]);
        }

        return true;
    }

    public function getDataByRule()
    {
        $array = [];
        foreach ($this->rule as $key => $value) {
            $array[$key] = $this->params[$key];
        }

        return $array;
    }

    /**
     * isPositiveInteger
     * @auth King
     *
     * @param $value
     * @param $rule
     * @param $data
     * @param $field
     *
     * @return bool|string
     */
    protected function isPositiveInteger($value, $rule = '', $data = [], $field = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }

        return false;
    }

    protected function isNotEmpty($value, $rule = '', $data = [], $field = '')
    {
        if (empty($value)) {
            return false;
        }

        return true;
    }

    protected function isMobile($value, $rule = '', $data = [], $field = '')
    {
        $pattern = '/^(13[0-9]|14[579]|15[0-3,5-9]|16[6]|17[0135678]|18[0-9]|19[89])\d{8}$/';
        if (!preg_match($pattern, $value)) {
            return false;
        }

        return true;
    }
}