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
    /**
     * goCheck
     * @auth King
     * @return bool
     * @throws ParameterException
     */
    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->param();
        $params['token'] = $request->header('token');

        if (!$this->batch()->check($params)) {
            throw new ParameterException([
                'message' => is_array($this->error) ? implode(';', $this->error) : $this->error,
                // 'message' => $this->error,
            ]);
        }

        return true;
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
}