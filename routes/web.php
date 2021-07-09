<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
/*--- Access Begin ---*/
$router->post( '/api/register', 'AuthController@register');
$router->post( '/api/login', 'AuthController@login' );
/*--- Access End ---*/
//
$router->group( [ 'middleware' => 'jwt', 'prefix' => 'api' ], function(  ) use ( $router ) {
  /*--- Session Begin ---*/
  $router->get( '/me', 'AuthController@me' );
  $router->post( '/logout', 'AuthController@logout' );
  $router->put( '/refresh', 'AuthController@refresh' );
  /*--- Session End ---*/

  /*--- Company Begin ---*/
  $router->get( '/companies', 'CompanyController@index' );
  $router->get( '/companies/list', 'CompanyController@list' );
  $router->post( '/companies/search', 'CompanyController@search' );
  $router->post( '/companies', 'CompanyController@store' );
  $router->get( '/companies/{id}', 'CompanyController@show' );
  $router->put( '/companies/{id}', 'CompanyController@update' );
  $router->patch( '/companies/{id}', 'CompanyController@update' );
  $router->delete( '/companies/{id}', 'CompanyController@destroy' );
  /*--- Company End ---*/

  /*--- Category Begin ---*/
  $router->get( '/categories', 'CategoryController@index' );
  $router->get( '/categories/list', 'CategoryController@list' );
  $router->post( '/categories/search', 'CategoryController@search' );
  $router->post( '/categories', 'CategoryController@store' );
  $router->get( '/categories/{id}', 'CategoryController@show' );
  $router->put( '/categories/{id}', 'CategoryController@update' );
  $router->patch( '/categories/{id}', 'CategoryController@update' );
  $router->delete( '/categories/{id}', 'CategoryController@destroy' );
  /*--- Category End ---*/

  /*--- Tag Begin ---*/
  $router->get( '/tags', 'TagController@index' );
  $router->get( '/tags/list', 'TagController@list' );
  $router->post( '/tags/search', 'TagController@search' );
  $router->post( '/tags', 'TagController@store' );
  $router->get( '/tags/{id}', 'TagController@show' );
  $router->put( '/tags/{id}', 'TagController@update' );
  $router->patch( '/tags/{id}', 'TagController@update' );
  $router->delete( '/tags/{id}', 'TagController@destroy' );
  /*--- Tag End ---*/

  /*--- Point Begin ---*/
  $router->get( '/points', 'PointController@index' );
  $router->get( '/points/list', 'PointController@list' );
  $router->post( '/points/search', 'PointController@search' );
  $router->post( '/points', 'PointController@store' );
  $router->get( '/points/{id}', 'PointController@show' );
  $router->put( '/points/{id}', 'PointController@update' );
  $router->patch( '/points/{id}', 'PointController@update' );
  $router->delete( '/points/{id}', 'PointController@destroy' );
  /*--- Point End ---*/

  /*--- Product Begin ---*/
  $router->get( '/products', 'ProductController@index' );
  $router->get( '/products/list', 'ProductController@list' );
  $router->post( '/products/search', 'ProductController@search' );
  $router->post( '/products', 'ProductController@store' );
  $router->get( '/products/{id}', 'ProductController@show' );
  $router->put( '/products/{id}', 'ProductController@update' );
  $router->patch( '/products/{id}', 'ProductController@update' );
  $router->delete( '/products/{id}', 'ProductController@destroy' );
  /*--- Product End ---*/

  /*--- Inventory Begin ---*/
  $router->get( '/inventories', 'InventoryController@index' );
  $router->get( '/inventories/list', 'InventoryController@list' );
  $router->post( '/inventories/search', 'InventoryController@search' );
  $router->post( '/inventories', 'InventoryController@store' );
  $router->get( '/inventories/{id}', 'InventoryController@show' );
  $router->put( '/inventories/{id}', 'InventoryController@update' );
  $router->patch( '/inventories/{id}', 'InventoryController@update' );
  $router->delete( '/inventories/{id}', 'InventoryController@destroy' );
  /*--- Inventory End ---*/

  /*--- Inventory Tag Begin ---*/
  $router->post( '/inventory/tags', 'InventoryTagController@store' );
  $router->get( '/inventory/tags/{inventory_id}', 'InventoryTagController@show' );
  $router->delete( '/inventory/tags/{id}', 'InventoryTagController@destroy' );
  /*--- Inventory Tag End ---*/

  /*--- Inventory Price Begin ---*/
  $router->post( '/inventory/prices', 'InventoryPriceController@store' );
  $router->get( '/inventory/prices/{inventory_id}', 'InventoryPriceController@show' );
  $router->delete( '/inventory/prices/{id}', 'InventoryPriceController@destroy' );
  /*--- Inventory Price End ---*/

  /*--- User Begin ---*/
  $router->get( '/users', 'UserController@index' );
  $router->get( '/users/list', 'UserController@list' );
  $router->post( '/users/search', 'UserController@search' );
  $router->post( '/users', 'UserController@store' );
  $router->get( '/users/{id}', 'UserController@show' );
  $router->put( '/users/{id}', 'UserController@update' );
  $router->patch( '/users/{id}', 'UserController@update' );
  $router->delete( '/users/{id}', 'UserController@destroy' );
  /*--- User End ---*/

  /*--- User Point Begin ---*/
  $router->post( '/user/points', 'UserPointController@store' );
  $router->get( '/user/points/{user_id}', 'UserPointController@show' );
  $router->get( '/user/points/{user_id}/count', 'UserPointController@count_points' );
  $router->delete( '/user/points/{id}', 'UserPointController@destroy' );
  /*--- User Point End ---*/

  /*--- Order Begin ---*/
  $router->get( '/orders', 'OrderController@index' );
  $router->get( '/orders/list', 'OrderController@list' );
  $router->post( '/orders', 'OrderController@store' );
  $router->get( '/orders/{id}', 'OrderController@show' );
  $router->get( '/user/orders/{user_id}', 'OrderController@user_orders' );
  $router->put( '/orders/{id}', 'OrderController@update' );
  $router->patch( '/orders/{id}', 'OrderController@update' );
  $router->delete( '/orders/{id}', 'OrderController@destroy' );
  /*--- Order End ---*/

  /*--- Order Details Begin ---*/
  $router->post( '/order/details', 'OrderDetailController@store' );
  $router->get( '/order/{order_id}/details/', 'OrderDetailController@show' );
  $router->get( '/user/order/details/{user_id}', 'OrderDetailController@user_orders' );
  $router->put( '/order/details/{id}', 'OrderDetailController@update' );
  $router->patch( '/order/details/{id}', 'OrderDetailController@update' );
  $router->delete( '/order/details/{id}', 'OrderDetailController@destroy' );
  /*--- Order Details End ---*/

} );
