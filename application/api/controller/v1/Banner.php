<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/2
 * Time: 09:45
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\validate\IdMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\MissException;

class Banner extends BaseController
{
    /**
     * getBanner
     * @auth King
     * @param int $id
     *
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws MissException
     * @throws \app\lib\exception\ParameterException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getBanner($id)
    {
        (new IdMustBePositiveInt())->goCheck();

        $banner = BannerModel::getBannerById($id);
        if (!$banner) {
            throw new MissException([
                'msg'       => '请求banner不存在',
                'errorCode' => 40000,
            ]);
        }

        return $banner;
    }
}