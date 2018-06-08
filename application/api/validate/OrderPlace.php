<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/6/7
 * Time: 15:14
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;

class OrderPlace extends BaseValidate
{
    public $products = [
        [
            'product_id' => 1,
            'number'     => 30,
        ],
        [
            'product_id' => 2,
            'number'     => 20,
        ],
    ];

    protected $rule = [
        'products' => 'require|checkProducts',
    ];

    protected $singleRule = [
        'product_id' => 'require|isPositiveInteger',
        'number'     => 'require|isPositiveInteger',
    ];

    /**
     * checkProducts
     * @auth King
     * @param $value
     *
     * @return bool
     * @throws ParameterException
     */
    protected function checkProducts($value)
    {
        if (empty($value)) {
            throw new ParameterException(['message' => '商品列表不能为空']);
        }

        if (!is_array($value)) {
            throw new ParameterException(['message' => '商品列表格式错误']);
        }

        foreach ($value as $item) {
            $this->checkProductItem($item);
        }

        return true;
    }

    /**
     * checkProductItem
     * @auth King
     * @param $value
     *
     * @return bool
     * @throws ParameterException
     */
    protected function checkProductItem($value)
    {
        $validate = new BaseValidate($this->singleRule);
        $result = $validate->check($value);

        if (!$result) {
            throw new ParameterException(['message' => $validate->error]);
        }

        return true;
    }
}