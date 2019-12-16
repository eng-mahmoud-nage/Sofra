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

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function(){

    // general pages
    Route::get('/cities', 'MainController@cities');
    Route::get('/districts', 'MainController@districts');
    Route::get('/setting', 'MainController@setting');
    Route::post('/set_contact', 'MainController@set_contact');
    Route::get('/categories', 'MainController@categories');

    Route::group(['prefix' => 'restaurant'], function (){

        // non auth pages on restaurants
        Route::post('/restaurant-login', 'restaurants\AuthController@login');
        Route::post('/restaurant-register', 'restaurants\AuthController@register');
        Route::post('/restaurant-reset-password', 'restaurants\AuthController@reset_password');
        Route::post('/restaurant-new-password', 'restaurants\AuthController@new_password');

        Route::group(['middleware' => 'auth:restaurant-api'], function (){
            Route::any('/restaurant-profile', 'restaurants\AuthController@profile');
            Route::post('/restaurant-change-password', 'restaurants\AuthController@change_password');

            Route::post('/create-product', 'general\ProductController@create_product');
            Route::get('/products', 'general\ProductController@products');
            Route::get('/product', 'general\ProductController@product');
            Route::post('/add-discount', 'general\ProductController@add_discount');

            Route::get('/accepted', 'general\OrderController@accepted');
            Route::get('/rejected', 'general\OrderController@rejected');
            Route::get('/canceled', 'general\OrderController@canceled');
            Route::get('/delivered', 'general\OrderController@delivered');

            Route::get('/orders', 'general\OrderController@orders');
            Route::get('/order', 'general\OrderController@order');

            Route::post('/set-offer', 'restaurants\OfferController@set_offer');
            Route::post('/update-offer', 'restaurants\OfferController@update_offer');
            Route::get('/offers', 'restaurants\OfferController@offers');
            Route::get('/offer', 'restaurants\OfferController@offer');

            Route::post('/set_token', 'general\TokenController@set_token');
            Route::get('/remove_token', 'general\TokenController@remove_token');
            Route::get('/token', 'general\TokenController@token');

            Route::get('/calc-transaction', 'MainController@calc_transaction');
            Route::get('/show-transaction', 'MainController@show_transaction');

//            Route::get('/notify', 'NotificationController@notification');
//            Route::get('/notification-list', 'NotificationController@notifications');
//            Route::get('/unread-notification', 'NotificationController@unread_notification');
//            Route::post('/set-read', 'NotificationController@set_read');
        });
    });

    Route::group(['prefix' => 'client'], function (){
        // non auth pages on clients
        Route::post('/client-login', 'clients\AuthController@login');
        Route::post('/client-register', 'clients\AuthController@register');
        Route::post('/client-reset-password', 'clients\AuthController@reset_password');
        Route::post('/client-new-password', 'clients\AuthController@new_password');

        Route::group(['middleware' => 'auth:client-api'], function (){
            Route::any('/client-profile', 'clients\AuthController@profile');
            Route::post('/client-change-password', 'clients\AuthController@change_password');

            Route::post('/create-order', 'general\OrderController@create_order');
            Route::get('/orders', 'general\OrderController@orders');
            Route::get('/order', 'general\OrderController@order');

            Route::get('/rejected', 'general\OrderController@rejected');
            Route::get('/canceled', 'general\OrderController@canceled');
            Route::get('/delivered', 'general\OrderController@delivered');

            Route::post('/set_token', 'MainController@set_token');
            Route::get('/remove_token', 'MainController@remove_token');
            Route::get('/token', 'MainController@token');

//            Route::get('/notify', 'NotificationController@notification');
//            Route::get('/notification-list', 'NotificationController@notifications');
//            Route::get('/unread-notification', 'NotificationController@unread_notification');
//            Route::post('/set-read', 'NotificationController@set_read');
        });
    });

});
