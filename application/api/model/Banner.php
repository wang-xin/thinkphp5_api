<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/2
 * Time: 15:58
 */

namespace app\api\model;

class Banner extends BaseModel
{
    protected $hidden = ['update_time', 'delete_time'];

    public function items()
    {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    /**
     * getBannerById
     * @auth King
     * @param $id
     *
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getBannerById($id)
    {
        $banner = self::with(['items', 'items.img'])->find($id);

        return $banner;
    }
}