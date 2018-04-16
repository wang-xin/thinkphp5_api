<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/16
 * Time: 11:18
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IdCollection;
use app\api\validate\IdMustBePositiveInt;
use app\lib\exception\ThemeException;

class Theme extends BaseController
{
    /**
     * getSimpleList
     * @auth King
     * @param string $ids
     *
     * @return false|\PDOStatement|string|\think\Collection
     * @throws ThemeException
     * @throws \app\lib\exception\ParameterException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getSimpleList($ids = '')
    {
        (new IdCollection())->goCheck();

        $ids = explode(',', $ids);
        $themes = ThemeModel::getThemeByIds($ids);
        if ($themes->isEmpty()) {
            throw new ThemeException();
        }

        return $themes;
    }

    /**
     * getComplexOne
     * @auth King
     * @param $id
     *
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws ThemeException
     * @throws \app\lib\exception\ParameterException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getComplexOne($id)
    {
        (new IdMustBePositiveInt())->goCheck();

        $theme = ThemeModel::getThemeWithProducts($id);
        if (!$theme) {
            throw new ThemeException();
        }

        $theme->hidden(['products.summary']);

        return $theme;
    }
}