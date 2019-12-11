<?php

use Illuminate\Http\Request;
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
    Route::get('/setting', 'MainController@setting');
    Route::post('/set_contact', 'MainController@set_contact');
    Route::get('/categories', 'MainController@categories');

    Route::group(['prefix' => 'resturant'], function (){

        // non auth pages on resturants
        Route::post('/resturant-login', 'resturants\AuthController@login');
        Route::post('/resturant-register', 'resturants\AuthController@register');
        Route::post('/resturant-reset-password', 'resturants\AuthController@reset_password');
        Route::post('/resturant-new-password', 'resturants\AuthController@new_password');
    
        Route::group(['middleware' => 'auth:resturant-api'], function (){
            Route::any('/resturant-profile', 'resturants\AuthController@profile');
            Route::post('/resturant-change-password', 'resturants\AuthController@change_password');

            Route::post('/set_token', 'DonationController@set_token');
            Route::get('/notify', 'NotificationController@notification');
            Route::get('/notification-list', 'NotificationController@notifications');
            Route::get('/unread-notification', 'NotificationController@unread_notification');
            Route::post('/set-read', 'NotificationController@set_read');
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

            Route::post('/set_token', 'DonationController@set_token');
            Route::get('/notify', 'NotificationController@notification');
            Route::get('/notification-list', 'NotificationController@notifications');
            Route::get('/unread-notification', 'NotificationController@unread_notification');
            Route::post('/set-read', 'NotificationController@set_read');
        });
    
    });


});

// Route::group(['namespace' => 'Api', 'prefix' => 'restaurnt/v1'], function (){

//     Route::post('/login', 'restraunts/AuthController@login');
//     Route::post('/register', 'restraunts/AuthController@register');
//     Route::post('/reset-password', 'restraunts/AuthController@reset_password');
//     Route::post('/new-password', 'restraunts/AuthController@new_password');

//     Route::group(['middleware' => 'auth:restaurnt-api'], function (){
//         Route::any('/profile', 'AuthController@profile');
//         Route::post('/change-password', 'AuthController@changePassword');
//         Route::post('/set_token', 'DonationController@set_token');
//         Route::get('/notify', 'NotificationController@notification');
//         Route::get('/notification-list', 'NotificationController@notifications');
//         Route::get('/unread-notification', 'NotificationController@unread_notification');
//         Route::post('/set-read', 'NotificationController@set_read');
//     });

// });

// Route::group(['namespace' => 'Api', 'prefix' => 'client/v1'], function (){

//     Route::post('/login', 'clients/AuthController@login');
//     Route::post('/register', 'clients/AuthController@register');
//     Route::post('/reset-password', 'clients/AuthController@reset_password');
//     Route::post('/new-password', 'clients/AuthController@new_password');

//     Route::group(['middleware' => 'auth:client-api'], function (){
//         Route::any('/profile', 'AuthController@profile');
//         Route::post('/change-password', 'AuthController@changePassword');
//         Route::post('/set_token', 'DonationController@set_token');
//         Route::get('/notify', 'NotificationController@notification');
//         Route::get('/notification-list', 'NotificationController@notifications');
//         Route::get('/unread-notification', 'NotificationController@unread_notification');
//         Route::post('/set-read', 'NotificationController@set_read');
//     });

// });