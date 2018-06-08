<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/6/7
 * Time: 14:09
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\validate\OrderPlace;
use app\api\service\Token as TokenService;
use app\api\service\Order as OrderService;

class Order extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder']
    ];

    public function placeOrder()
    {
        $validate = new OrderPlace();
        $validate->goCheck();

        $uid = TokenService::getCurrentUid();
        $products = $validate->getDataByRule();

        $orderService = new OrderService();
        $result = $orderService->place($uid, $products);
    }
}