<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'api'], function ($router) {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');

    // ROUTES WITH AUTH
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('me', 'UserController@me');
        Route::get('users', 'UserController@getUsers');
        Route::post('refresh', 'Auth\AuthController@refresh');

        // RESTful routes for Client
        Route::get('clients', 'ClientController@index');          // GET all clients
        Route::get('clients/{id}', 'ClientController@show');      // GET a single client by ID
        Route::post('clients', 'ClientController@store');         // POST create a new client
        Route::put('clients/{id}', 'ClientController@update');    // PUT update a client by ID
        Route::delete('clients/{id}', 'ClientController@destroy');// DELETE a client (soft delete)

        // RESTful routes for ProductType
        Route::get('product-types', 'ProductTypeController@index');          // GET all product types
        Route::get('product-types/{id}', 'ProductTypeController@show');      // GET a single product type by ID
        Route::post('product-types', 'ProductTypeController@store');         // POST create a new product type
        Route::put('product-types/{id}', 'ProductTypeController@update');    // PUT update a product type by ID
        Route::delete('product-types/{id}', 'ProductTypeController@destroy');// DELETE a product type (soft delete)

        // RESTful routes for Product
        Route::get('products', 'ProductController@index');          // GET all products
        Route::get('products/{id}', 'ProductController@show');      // GET a single product by ID
        Route::post('products', 'ProductController@store');         // POST create a new product
        Route::put('products/{id}', 'ProductController@update');    // PUT update a product by ID
        Route::delete('products/{id}', 'ProductController@destroy');// DELETE a product (soft delete)

        // RESTful routes for Order
        Route::get('orders', 'OrderController@index');          // GET all orders
        Route::get('orders/{id}', 'OrderController@show');      // GET a single order by ID
        Route::post('orders', 'OrderController@store');         // POST create a new order
        Route::put('orders/{id}', 'OrderController@update');    // PUT update an order by ID
        Route::delete('orders/{id}', 'OrderController@destroy');// DELETE an order (soft delete)

        // RESTful routes for OrderProduct (many-to-many relationship)
        Route::get('order-products', 'OrderProductController@index');                          // GET all order-product relationships
        Route::get('order-products/{orderId}/{productId}', 'OrderProductController@show');     // GET a single order-product relationship
        Route::post('order-products', 'OrderProductController@store');                        // POST create a new order-product relationship
        Route::put('order-products/{orderId}/{productId}', 'OrderProductController@update');   // PUT update an order-product relationship
        Route::delete('order-products/{orderId}/{productId}', 'OrderProductController@destroy');// DELETE an order-product relationship
    });
});
