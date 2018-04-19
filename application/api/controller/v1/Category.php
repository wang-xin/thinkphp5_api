<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/19
 * Time: 15:00
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Category as CategoryModel;
use app\api\validate\IdMustBePositiveInt;
use app\lib\exception\CategoryException;

class Category extends BaseController
{
    /**
     * 获取全部类目列表，但不包含类目下的商品
     * getAll
     * @auth King
     * @return false|\PDOStatement|string|\think\Collection
     * @throws CategoryException
     */
    public function getAll()
    {
        $categories = CategoryModel::getAllCategories();
        if ($categories->isEmpty()) {
            throw new CategoryException();
        }

        return $categories;
    }

    /**
     * getOne
     * @auth King
     * @param $id
     *
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws CategoryException
     * @throws \app\lib\exception\ParameterException
     */
    public function getOne($id)
    {
        (new IdMustBePositiveInt())->goCheck();

        $category = CategoryModel::getCategoryById($id);

        if (!$category) {
            throw new CategoryException();
        }

        return $category;
    }
}