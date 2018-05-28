<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/5/28
 * Time: 09:37
 */

namespace app\api\validate;


class Address extends BaseValidate
{
    protected $rule = [
        'name'     => 'require|isNotEmpty',
        'mobile'   => 'require|isMobile',
        'province' => 'require|isNotEmpty',
        'city'     => 'require|isNotEmpty',
        'country'  => 'require|isNotEmpty',
        'detail'   => 'require|isNotEmpty',
    ];
}