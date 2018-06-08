<?php

namespace app\api\controller;

use app\api\service\Token;
use think\Controller;

class BaseController extends Controller
{
    public function checkPrimaryScope()
    {
        Token::needPrimaryScope();
    }

    public function checkExclusiveScope()
    {
        Token::needExclusiveScope();
    }

    public function checkSuperScope()
    {
        Token::needSuperScope();
    }
}
