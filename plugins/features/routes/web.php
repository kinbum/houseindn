<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/**
 * Admin routes
 */

$adminRoute = config('webed.admin_route');

$moduleRoute = 'features';

Route::group(['prefix' => $adminRoute . '/' . $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    // Amenities route
    $router->get('amenities', 'AmenitiesController@getIndex')
        ->name('amenities.index.get')
        ->middleware('has-permission::view-amenities');
        
    $router->post('amenities', 'AmenitiesController@postListing')
        ->name('amenities.index.post')
        ->middleware('has-permission::view-amenities');
        
    $router->get('amenities/create', 'AmenitiesController@getCreate')
        ->name('amenities.create.get')
        ->middleware('has-permission:view-amenities');

    $router->post('amenities/create', 'AmenitiesController@postCreate')
        ->name('amenities.create.post')
        ->middleware('has-permission:create-amenities');
        
    $router->get('amenities/edit/{id}', 'AmenitiesController@getEdit')
        ->name('amenities.edit.get')
        ->middleware('has-permission:view-amenities');

    $router->post('amenities/edit/{id}', 'AmenitiesController@postEdit')
        ->name('amenities.edit.post')
        ->middleware('has-permission:update-amenities');

    $router->delete('amenities/{id}', 'AmenitiesController@deleteDelete')
        ->name('amenities.delete.delete')
        ->middleware('has-permission:delete-amenities');

    // Assets route
    $router->get('assets', 'AssetController@getIndex')
        ->name('assets.index.get')
        ->middleware('has-permission:view-assets');

    $router->post('assets', 'AssetController@postListing')
        ->name('assets.index.post')
        ->middleware('has-permission:view-assets');

    $router->get('assets/create', 'AssetController@getCreate')
        ->name('assets.create.get')
        ->middleware('has-permission:view-assets');

    $router->post('assets/create', 'AssetController@postCreate')
        ->name('assets.create.post')
        ->middleware('has-permission:create-assets');
        
    $router->get('assets/edit/{id}', 'AssetController@getEdit')
        ->name('assets.edit.get')
        ->middleware('has-permission:view-assets');

    $router->post('assets/edit/{id}', 'AssetController@postEdit')
        ->name('assets.edit.post')
        ->middleware('has-permission:update-assets');

    $router->delete('assets/{id}', 'AssetController@deleteDelete')
        ->name('assets.delete.delete')
        ->middleware('has-permission:delete-assets');

    // Kind route
    $router->get('kinds', 'KindController@getIndex')
        ->name('kinds.index.get')
        ->middleware('has-permission:view-kinds');

    $router->post('kinds', 'KindController@postListing')
        ->name('kinds.index.post')
        ->middleware('has-permission:view-kinds');

    $router->get('kinds/create', 'KindController@getCreate')
        ->name('kinds.create.get')
        ->middleware('has-permission:view-kinds');

    $router->post('kinds/create', 'KindController@postCreate')
        ->name('kinds.create.post')
        ->middleware('has-permission:create-kinds');
        
    $router->get('kinds/edit/{id}', 'KindController@getEdit')
        ->name('kinds.edit.get')
        ->middleware('has-permission:view-kinds');

    $router->post('kinds/edit/{id}', 'KindController@postEdit')
        ->name('kinds.edit.post')
        ->middleware('has-permission:update-kinds');

    $router->delete('kinds/{id}', 'KindController@deleteDelete')
        ->name('kinds.delete.delete')
        ->middleware('has-permission:delete-kinds');
});
