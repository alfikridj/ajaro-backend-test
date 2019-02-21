<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'middleware' => 'cors'], function () {

    /* ------------ Auth ------------ */
    Route::post('login', ['as' => 'login','uses' => 'UserController@authenticate']);
    Route::group(['prefix' => 'register'], function () {
        Route::post('/admin', ['as' => 'register.admin','uses' => 'UserController@register']);
        Route::post('/customer', ['as' => 'register.customer','uses' => 'UserController@register']);
    });
    Route::group(['prefix' => 'update', 'middleware' => 'jwt.verify'], function () {
        Route::post('/admin', ['as' => 'update.admin', 'uses' => 'UserController@update']);
        Route::post('/customer', ['as' => 'update.customer', 'uses' => 'UserController@update']);
    });

    Route::group(['middleware' => ['jwt.verify']], function() {

        Route::get('/user', ['as' => 'user', 'uses' => 'UserController@getAuthenticatedUser']);

        /* ------------ Category ------------ */
        Route::group(['prefix' => 'category'], function () {
            Route::post('/', ['as' => 'category.create', 'uses' => 'CategoryController@create_category']);
            Route::get('/', ['as' => 'category.show.all', 'uses' => 'CategoryController@show_all_category']);
            Route::get('/{id}', ['as' => 'category.show.id', 'uses' => 'CategoryController@show_by_id_category']);
            Route::post('/name', ['as' => 'category.show.name', 'uses' => 'CategoryController@show_by_name_category']);
            Route::post('/{id}', ['as' => 'category.update', 'uses' => 'CategoryController@update_category']);
            Route::delete('/{id}', ['as' => 'category.delete', 'uses' => 'CategoryController@delete_category']);
        });

        /* ------------ Product ------------ */
        Route::group(['prefix' => 'product'], function () {
            Route::post('/', ['as' => 'product.create', 'uses' => 'ProductController@create_product']);
            Route::get('/', ['as' => 'product.show.all', 'uses' => 'ProductController@show_all_product']);
            Route::get('/{id}', ['as' => 'product.show.id', 'uses' => 'ProductController@show_by_id_product']);
            Route::post('/name', ['as' => 'product.show.name', 'uses' => 'ProductController@show_by_name_product']);
            Route::get('/category/{id}', ['as' => 'product.show.categoryid', 'uses' => 'ProductController@show_by_category_id_product']);
            Route::post('/{id}', ['as' => 'product.update', 'uses' => 'ProductController@update_product']);
            Route::delete('/{id}', ['as' => 'product.delete', 'uses' => 'ProductController@delete_product']);
        });

        /* ------------ Customer ------------ */
        Route::group(['prefix' => 'customer'], function () {
            Route::get('/', ['as' => 'customer.show.all', 'uses' => 'CustomerController@show_all_customer']);
            Route::get('/{id}', ['as' => 'customer.show.id', 'uses' => 'CustomerController@show_by_id_customer']);
            Route::post('/name', ['as' => 'customer.show.name', 'uses' => 'CustomerController@show_by_name_customer']);
            Route::delete('/{id}', ['as' => 'customer.delete', 'uses' => 'CustomerController@delete_customer']);
        });

        /* ------------ Order ------------ */
        Route::group(['prefix' => 'order'], function () {
            Route::post('/', ['as' => 'order.create', 'uses' => 'OrderController@create_order']);
            Route::get('/', ['as' => 'order.show.all', 'uses' => 'OrderController@show_all_order']);
            Route::get('/{id}', ['as' => 'order.show.id', 'uses' => 'OrderController@show_by_id_order']);
            Route::get('/user/{userid}', ['as' => 'order.show.all.userid', 'uses' => 'OrderController@show_all_by_user_id_order']);
            Route::get('/{id}/user/{userid}', ['as' => 'order.show.id.userid', 'uses' => 'OrderController@show_id_by_user_id_order']);

            /* ------------ Order Detail ------------ */
            Route::group(['prefix' => 'detail'], function () {
                Route::post('/', ['as' => 'order.detail.create', 'uses' => 'OrderController@create_order']);
                Route::get('/all', ['as' => 'order.detail.show.all', 'uses' => 'OrderController@show_all_orderdetail']);
                Route::get('/{id}', ['as' => 'order.detail.show.id', 'uses' => 'OrderController@show_by_id_orderdetail']);
                Route::get('/order/{id}', ['as' => 'order.detail.show.all.orderid', 'uses' => 'OrderController@show_all_by_order_id_orderdetail']);
                Route::get('/product/{id}', ['as' => 'order.detail.show.all.productid', 'uses' => 'OrderController@show_all_by_product_id_orderdetail']);
            });
        });

        /* ------------ Address ------------ */
        Route::group(['prefix' => 'address'], function () {
            Route::post('/', ['as' => 'address.create', 'uses' => 'AddressController@create_address']);
            Route::get('/', ['as' => 'address.show.all', 'uses' => 'AddressController@show_all_address']);
            Route::post('/{id}', ['as' => 'address.update', 'uses' => 'AddressController@update_address']);
            Route::get('/{id}', ['as' => 'address.show.id', 'uses' => 'AddressController@show_by_id_address']);
            Route::get('/user/{id}', ['as' => 'address.show.all.userid', 'uses' => 'AddressController@show_all_by_user_id_address']);
            Route::get('/{id}/user/{userid}', ['as' => 'address.show.all.userid', 'uses' => 'AddressController@show_id_by_user_id_address']);
            Route::delete('/{id}/user/{userid}', ['as' => 'address.delete', 'uses' => 'AddressController@delete_address_id_by_user_id']);
        });
    });
});



