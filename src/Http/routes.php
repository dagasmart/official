<?php

use DagaSmart\Official\Http\Controllers;
use DagaSmart\Official\Http\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use DagaSmart\BizAdmin\Middleware\Permission;
use DagaSmart\BizAdmin\Middleware\Authenticate;


//需登录与鉴权
Route::group([
    'prefix' => 'official', //需要时可填
    'middleware' => [
        Middleware\Middleware::class,
    ],
], function (Router $router) {
    $router->get('site/settings', [Controllers\SettingController::class, 'settings']);

    $router->get('official', [Controllers\OfficialController::class, 'index']);

    //resource必须放最后面
    //$router->resource('official', Controllers\OfficialController::class);
});

//免登录无限制
//Route::get('official', [Controllers\OfficialController::class, 'index'])->withoutMiddleware([Authenticate::class, Permission::class]);
