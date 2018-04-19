<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/19
 * Time: 15:01
 */

namespace app\api\model;

class Category extends BaseModel
{
    protected $hidden = ['topic_img_id', 'update_time', 'delete_time'];

    public function topicImg()
    {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }
    
    public static function getAllCategories()
    {
        return self::with('topicImg')->select();
    }

    public static function getCategoryById($id)
    {
        return self::with('topicImg')->find($id);
    }
}