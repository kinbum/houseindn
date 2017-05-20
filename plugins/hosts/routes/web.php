<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/**
 * Admin routes
 */

$adminRoute = config('webed.admin_route');

$moduleRoute = 'hosts';

Route::group(['prefix' => $adminRoute . '/' . $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->get('/', 'HostController@getIndex')
        ->name('hosts.index.get')
        ->middleware('has-permission:view-host');
});
