<?php

namespace app\api\model;

class Theme extends BaseModel
{
    protected $hidden = ['topic_img_id', 'head_img_id', 'create_time', 'update_time', 'delete_time'];

    public function topicImg()
    {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }

    public function headImg()
    {
        return $this->belongsTo('Image', 'head_img_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany('Product', 'theme_product', 'product_id', 'theme_id');
    }

    /**
     * getThemeByIds
     * @auth King
     *
     * @param $ids
     *
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getThemeByIds($ids)
    {
        return self::with(['topicImg', 'headImg'])->select($ids);
    }

    /**
     * getThemeWithProducts
     * @auth King
     *
     * @param $id
     *
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getThemeWithProducts($id)
    {
        return self::with(['topicImg', 'headImg', 'products'])->find($id);
    }
}
