<?php

use DagaSmart\BizAdmin\Middleware\Authenticate;
use DagaSmart\BizAdmin\Middleware\Permission;
use DagaSmart\Official\Http\Controllers;
use DagaSmart\Official\Http\Middleware;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

// 需登录与鉴权
Route::group([
    'prefix' => 'extension', // 选填，扩展路由
    'middleware' => [
        Middleware\Middleware::class,
    ],
], function (Router $router) {
    $router->get('official', [Controllers\OfficialController::class, 'index']);

    $router->resource('official/contact', Controllers\ContactController::class);
    // resource必须放最后面 (重点)
    // $router->resource('official', Controllers\OfficialController::class);
});

// 免登录无限制
// Route::get('official', [Controllers\OfficialController::class, 'index'])->withoutMiddleware([Authenticate::class, Permission::class]);
