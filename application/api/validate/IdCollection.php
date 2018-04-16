<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/16
 * Time: 15:35
 */

namespace app\api\validate;

class IdCollection extends BaseValidate
{
    protected $rule = [
        'ids' => 'require|checkIds',
    ];

    protected $message = [
        'ids' => 'ids参数必须为以逗号分隔的多个正整数',
    ];

    protected function checkIds($value)
    {
        $values = explode(',', $value);
        if (empty($values)) {
            return false;
        }

        foreach ($values as $id) {
            if (!$this->isPositiveInteger($id)) {
                return false;
            }
        }

        return true;
    }
}