<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/16
 * Time: 17:23
 */

namespace app\api\model;

class ProductProperty extends BaseModel
{
    protected $hidden = ['id', 'product_id', 'update_time', 'delete_time'];

}