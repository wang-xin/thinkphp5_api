<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/16
 * Time: 17:28
 */

namespace app\api\model;

class ProductImage extends BaseModel
{
    protected $hidden = ['id', 'img_id', 'order', 'product_id', 'delete_time'];

    public function imgUrl()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}