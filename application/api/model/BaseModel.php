<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/2
 * Time: 16:06
 */

namespace app\api\model;

use think\Model;
use traits\model\SoftDelete;

class BaseModel extends Model
{
    use SoftDelete;

    protected $hidden = ['delete_time'];


}