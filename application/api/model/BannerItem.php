<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/2
 * Time: 17:48
 */

namespace app\api\model;


class BannerItem extends BaseModel
{
    protected $hidden = ['id', 'img_id', 'banner_id', 'update_time', 'delete_time'];

    public function img()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}