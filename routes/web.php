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
    return view('home');
});
Route::get('login', 'LoginController@loginForm')->name('login');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout')->name('logout');
Route::get('register', 'RegisterController@registerForm')->name('register');
Route::post('register', 'RegisterController@register');
Route::group(['middleware' => ['auth']], function(){
    Route::get('admin', ['as' => 'admin', function(){
        return view('admin/admin');
    }]);
    Route::get('bidder', ['as' => 'bidder', 'uses' => 'BidderController@bidderView']);
    Route::get('bidder', ['as' => 'bidder', 'uses' => 'BidderController@getRole']);
    //Route::get('developer', 'BidderController@getRole')->name);
    Route::get('seeker', ['as' => 'seeker', 'uses' => 'SeekerController@seekerData']);
    Route::get('seeker', ['as' => 'seeker', 'uses' => 'SeekerController@getRole']);
    Route::get('calendar', ['as' => 'calendar', function(){
        return view('admin/calendar');
    }]); 
});
