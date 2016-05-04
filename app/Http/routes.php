<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::get('/aboutus', 'BaseController@aboutus');

Route::get('/cms', 'BaseController@index');

Route::get('/contacts', 'BaseController@contacts');

Route::get('/welcome', 'BaseController@welcome');

Route::get('/frame/{id}', 'BaseController@frame');

Route::get('/login', 'BaseController@userlogin');

Route::get('items/search/{id}', 'BaseController@search');

Route::get('api', 'ApiController@api');

Route::get('frontpage', 'ApiController@index');

Route::get('/cache', 'BaseController@write');

Route::group(['prefix' => 'backend', 'middleware' => 'admin:user'], function () {
    Route::get('/user', 'BackendController@userDashboard');
    Route::get('user-orders', 'BackendController@userOrders');
    Route::any('user-orders/edit', 'BackendController@userOrdersEdit');
    Route::get('profile', 'BackendController@profile');
    Route::group(['middleware' => 'user'], function () {
        Route::any('profile/edit', 'BackendController@profileEdit');
    });
});

Route::group(['prefix' => 'backend', 'middleware' => 'admin:admin'], function () {
    Route::get('products', 'BackendController@products');
    Route::any('products/edit', 'BackendController@productsEdit');
    Route::get('orders', 'BackendController@orders');
    Route::any('orders/edit', 'BackendController@ordersEdit');
    Route::get('articles/search', 'ArticlesController@search');
    Route::get('/admin', 'UsersController@dashboard');
    Route::get('roles', 'UsersController@role');
    Route::post('roles', 'UsersController@createRole');
    Route::resource('users', 'UsersController');
    Route::resource('articles', 'ArticlesController');
});

Route::controller('cart', 'CartController');

Route::get('/filter/{slug}/{id}', 'BaseController@filter');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Routers::registerRoutes();

//App::make('Helper')->registerRoutes();

//require app_path().'/Http/Routes/routes.php';

//Route::get('role/create_role', 'RolesController@create_role');

//Route::get('role/attach_role', 'RolesController@attach_role');