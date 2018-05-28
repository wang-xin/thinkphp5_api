<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/19
 * Time: 15:36
 */

namespace app\api\model;

class User extends BaseModel
{
    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }
    
    public static function getUserByOpenid($openid)
    {
        return self::where('openid', '=', $openid)->find();
    }
}