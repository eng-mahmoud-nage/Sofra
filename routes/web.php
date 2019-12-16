<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// routes for website with auth guard {{restaurnt,client}-web}

Route::group([],function(){

    Route::get('/cities', 'MainController@cities');
    Route::get('/setting', 'MainController@setting');
    Route::post('/contacts', 'MainController@contacts');
    Route::get('/categories', 'MainController@categories');

    Route::group(['prefix' => 'restaurnt'], function (){

        Route::post('/login', 'restraunts/AuthController@login');
        Route::post('/register', 'restraunts/AuthController@register');
        Route::post('/reset-password', 'restraunts/AuthController@reset_password');
        Route::post('/new-password', 'restraunts/AuthController@new_password');

        Route::group(['middleware' => 'auth:restaurnt-web'], function (){
            Route::any('/profile', 'AuthController@profile');
            Route::post('/change-password', 'AuthController@changePassword');
            Route::post('/set_token', 'DonationController@set_token');
            Route::get('/notify', 'NotificationController@notification');
            Route::get('/notification-list', 'NotificationController@notifications');
            Route::get('/unread-notification', 'NotificationController@unread_notification');
            Route::post('/set-read', 'NotificationController@set_read');
        });
    });


    Route::group(['prefix' => 'client'], function (){

        Route::post('/login', 'clients/AuthController@login');
        Route::post('/register', 'clients/AuthController@register');
        Route::post('/reset-password', 'clients/AuthController@reset_password');
        Route::post('/new-password', 'clients/AuthController@new_password');

        Route::group(['middleware' => 'auth:client-web'], function (){
            Route::any('/profile', 'AuthController@profile');
            Route::post('/change-password', 'AuthController@changePassword');
            Route::post('/set_token', 'DonationController@set_token');
            Route::get('/notify', 'NotificationController@notification');
            Route::get('/notification-list', 'NotificationController@notifications');
            Route::get('/unread-notification', 'NotificationController@unread_notification');
            Route::post('/set-read', 'NotificationController@set_read');
        });
    });

});


// routes for admin with auth guard {web}

// login socialite {facebook, github, google}
Route::get('auth/{provider}', 'Auth\AuthLoginSocialiteController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthLoginSocialiteController@handleProviderCallback');

Auth::routes();
Route::group(['middleware' => ['auth:web', 'AutoCheckPermission'], 'prefix' => 'admin'], function () {
    // dashboard page
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    // Profile page
    Route::get('/profile', function () {
        return view('admin.admins.profile');
    });
    Route::get('/home', 'HomeController@index');
    // pages
    Route::post('/changepass', 'Auth\ChangePasswordController@changepass');
    Route::any('/edit-profile', 'HomeController@edit_profile');

    Route::resource('client', 'ClientController');
    Route::resource('restaurant', 'RestaurantController');
    Route::resource('product', 'ProductController');
    Route::resource('order', 'OrderController');
    Route::resource('offer', 'OfferController');
    Route::resource('review', 'ReviewController');

    Route::resource('city', 'CityController');
    Route::resource('district', 'DistrictController');

    Route::resource('category', 'CategoryController');

    Route::resource('setting', 'SettingController');
    Route::resource('contact', 'ContactController');

    Route::resource('notification', 'NotificationController');

    Route::resource('admin', 'AdminController');
    Route::resource('role', 'Role\RoleController');
    Route::resource('permission', 'Role\PermissionController');
    Route::resource('transaction', 'TransactionController');



    Route::get('/search', 'PostController@index');

});

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::resource('restaurant', 'RestaurantController');
// Route::resource('city', 'CityController');
// Route::resource('district', 'DistrictController');
// Route::resource('category', 'CategoryController');
// Route::resource('prouduct', 'ProductController');
// Route::resource('categoryrestaurants', 'CategoryRestaurantsController');
// Route::resource('order', 'OrderController');
// Route::resource('productorders', 'ProductOrdersController');
// Route::resource('paymentmethod', 'PaymentMethodController');
// Route::resource('transaction', 'TransactionController');
// Route::resource('offer', 'OfferController');
// Route::resource('client', 'ClientController');
// Route::resource('evaluation', 'EvaluationController');
// Route::resource('setting', 'SettingController');
// Route::resource('contact', 'ContactController');
// Route::resource('notification', 'NotificationController');
// Route::resource('clientable', 'ClientableController');
// Route::resource('restaurantable', 'RestaurantableController');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
