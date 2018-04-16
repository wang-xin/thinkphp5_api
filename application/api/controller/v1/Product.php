<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/16
 * Time: 16:23
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\api\validate\IdMustBePositiveInt;
use app\lib\exception\ProductException;

class Product extends BaseController
{
    /**
     * 获取指定数量的最近商品
     * getRecent
     * @auth King
     *
     * @param int $count
     *
     * @return false|\PDOStatement|string|\think\Collection
     * @throws ProductException
     * @throws \app\lib\exception\ParameterException
     */
    public function getRecent($count = 15)
    {
        (new Count())->goCheck();

        $products = ProductModel::getMostRecent($count);
        if ($products->isEmpty()) {
            throw new ProductException();
        }

        return $products;
    }

    /**
     * getOne
     * @auth King
     * @param $id
     *
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws ProductException
     * @throws \app\lib\exception\ParameterException
     */
    public function getOne($id)
    {
        (new IdMustBePositiveInt())->goCheck();

        $product = ProductModel::getProductDetail($id);
        if (!$product) {
            throw new ProductException();
        }

        return $product;
    }
}