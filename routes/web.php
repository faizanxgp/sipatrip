<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('dashboard');

Route::get('/test', 'HomeController@test')->name('test');
Route::get('/test2', 'HomeController@test2')->name('test2');

Route::get('/hotels', 'HomeController@getHotels')->name('user.hotels');
Route::post('/hotels/search', 'HomeController@postHotelsSearch')->name('user.hotels.search');
Route::get('/hotels/details/{id}', 'HomeController@getHotelDetails')->name('user.hotel.details');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

    Route::get('/users/agent', 'AdminController@getUsersAgent')->name('admin.users.agent');
    Route::get('/user/agent/{id}', 'AdminController@getUserAgent')->name('admin.user.agent');

    Route::get('/users/hotel', 'AdminController@getUsersHotel')->name('admin.users.hotel');
    Route::get('/user/hotel/{id}', 'AdminController@getUserHotel')->name('admin.user.hotel');

    Route::get('/users/airline', 'AdminController@getUsersAirline')->name('admin.users.airline');
    Route::get('/user/airline/{id}', 'AdminController@getUserAirline')->name('admin.user.airline');



    Route::get('/test', 'AdminController@test')->name('admin.test');
});


Route::prefix('hotel')->group(function() {

    Route::get('/register', 'Auth\HotelRegisterController@RegistrationForm')->name('hotel.register');
    Route::post('/register', 'Auth\HotelRegisterController@register')->name('hotel.register-submit');

    Route::get('/login', 'Auth\HotelLoginController@showLoginForm')->name('hotel.login');
    Route::post('/login', 'Auth\HotelLoginController@login')->name('hotel.login.submit');
    Route::get('/logout', 'Auth\HotelLoginController@logout')->name('hotel.logout');

    Route::get('/dashboard', 'HotelController@index')->name('hotel.dashboard');
});


Route::prefix('airline')->group(function() {
    Route::get('/login', 'Auth\AirlineLoginController@showLoginForm')->name('airline.login');
    Route::post('/login', 'Auth\AirlineLoginController@login')->name('airline.login.submit');
    Route::get('/logout', 'Auth\AirlineLoginController@logout')->name('airline.logout');

    Route::get('/dashboard', 'AirlineController@index')->name('airline.dashboard');
});