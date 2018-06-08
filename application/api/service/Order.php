<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/6/7
 * Time: 15:44
 */

namespace app\api\service;


use app\api\model\Product;

class Order
{
    public function place($uid, $products)
    {

    }

    private function getProductsByOrder($oProducts)
    {
        $oProductIds = array_column($oProducts, 'product_id');

        $products = Product::all($oProductIds)->visible(['id', 'price', 'stock', 'name', 'main_img_url'])->toArray();

        return $products;
    }
}