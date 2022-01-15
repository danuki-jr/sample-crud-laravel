<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', 'IndexController@index');

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('products/fetch',  ['uses' => 'Api\ProductController@showAll']);
    $router->post('products/add',  ['uses' => 'Api\ProductController@create']);
    $router->post('products/update',  ['uses' => 'Api\ProductController@update']);
    $router->post('products/delete',  ['uses' => 'Api\ProductController@delete']);
});
