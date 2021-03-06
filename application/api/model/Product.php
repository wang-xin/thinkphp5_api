<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/16
 * Time: 11:21
 */

namespace app\api\model;

use think\db\Query;

class Product extends BaseModel
{
    protected $hidden = ['from', 'create_time', 'update_time', 'delete_time', 'img_id', 'pivot'];

    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    public function properties()
    {
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('ProductImage', 'product_id', 'id');
    }

    public static function getMostRecent($count)
    {
        return self::order(['create_time' => 'desc'])->limit($count)->select();
    }

    public static function getProductsByCategoryId($id)
    {
        return self::where('category_id', '=', $id)->select();
    }

    public static function getProductDetail($id)
    {
        return self::with(['properties'])
            ->with(['images' => function (Query $query) {
                $query->with(['imgUrl'])->order(['order' => 'asc']);
            }])
            ->find($id);
    }
}