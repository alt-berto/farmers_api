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
  $router->get( '/companies/{id}/users', 'CompanyController@users' );
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
  $router->get( '/categories/{id}/users', 'CategoryController@users' );
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
  $router->get( '/tags/{id}/users', 'TagController@users' );
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
  $router->get( '/points/{id}/users', 'PointController@users' );
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
  $router->get( '/products/{id}/users', 'ProductController@users' );
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
  $router->get( '/inventories/{id}/users', 'InventoryController@users' );
  $router->put( '/inventories/{id}', 'InventoryController@update' );
  $router->patch( '/inventories/{id}', 'InventoryController@update' );
  $router->delete( '/inventories/{id}', 'InventoryController@destroy' );
  /*--- Inventory End ---*/

} );
