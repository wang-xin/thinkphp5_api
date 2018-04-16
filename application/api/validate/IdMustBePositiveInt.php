<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/2
 * Time: 15:09
 */

namespace app\api\validate;


class IdMustBePositiveInt extends BaseValidate
{
    public $rule = [
        'id' => 'require|isPositiveInteger'
    ];

    protected $message = [
        'id' => 'id 必须是正整数'
    ];
}