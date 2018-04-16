<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2018/4/16
 * Time: 16:45
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\lib\exception\MissException;

class Miss extends BaseController
{
    /**
     * index
     * @auth King
     * @throws MissException
     */
    public function miss()
    {
        throw new MissException();
    }
}