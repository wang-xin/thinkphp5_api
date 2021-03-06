<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::get(':version/banner/:id', 'api/:version.Banner/getBanner');

// Route::get(':version/theme', 'api/:version.Theme/getSimpleList');
// Route::get(':version/theme/:id', 'api/:version.Theme/getComplexOne');
Route::group(':version/theme', function () {
    Route::get('', 'api/:version.Theme/getSimpleList');
    Route::get(':id', 'api/:version.Theme/getComplexOne');
});

Route::get(':version/category', 'api/:version.Category/getAll');
Route::get(':version/category/:id', 'api/:version.Category/getOne');

Route::get(':version/product/recent', 'api/:version.Product/getRecent');
Route::get(':version/product/by_category', 'api/:version.Product/getAllByCategoryId');
Route::get(':version/product/:id', 'api/:version.Product/getOne');

Route::post(':version/token/user', 'api/:version.Token/getToken');

Route::post(':version/user/address', 'api/:version.Address/createOrUpdateAddress');

Route::miss('api/v1.Miss/miss');
