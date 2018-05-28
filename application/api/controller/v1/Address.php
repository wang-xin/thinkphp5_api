<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/5/28
 * Time: 09:33
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\User;
use app\api\validate\Address as AddressValidate;
use app\api\service\Token as TokenService;
use app\lib\exception\SuccessMessageException;
use app\lib\exception\UserException;

class Address extends BaseController
{
    /**
     * createOrUpdateAddress
     * @auth King
     * @throws SuccessMessageException
     * @throws UserException
     * @throws \app\lib\exception\ParameterException
     * @throws \app\lib\exception\TokenException
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function createOrUpdateAddress()
    {
        $validate = new AddressValidate();
        $validate->goCheck();

        $uid = TokenService::getCurrentUid();
        $user = User::get($uid);
        if (!$user) {
            throw new UserException();
        }

        $data = $validate->getDataByRule();
        if ($user->address) {
            // update
            $user->address->save($data);
        } else {
            // create
            $user->address()->save($data);
        }

        throw new SuccessMessageException();
    }
}