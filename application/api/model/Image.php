<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/3
 * Time: 14:58
 */

namespace app\api\model;

class Image extends BaseModel
{
    protected $hidden = ['id', 'from', 'update_time', 'delete_time'];

    protected function getUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }
}