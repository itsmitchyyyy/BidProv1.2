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
    Route::get('admin/dashboard', ['as' => 'admin', function(){
        return view('admin/admin');
    }]);
   // Route::get('bidder', ['as' => 'bidderAdmin', 'uses' => 'BidderController@bidderView']);
    Route::get('list/bidder', ['as' => 'bidderAdmin', 'uses' => 'BidderController@getRole']);
    //Route::get('developer', 'BidderController@getRole')->name);
   // Route::get('admin.seeker', ['as' => 'adminSeeker', 'uses' => 'SeekerController@seekerData']);
    Route::get('list/seeker', ['as' => 'adminSeeker', 'uses' => 'SeekerController@getRole']);
    Route::get('calendar', ['as' => 'calendarAdmin', function(){
        return view('admin/calendar');
    }]); 
    //Route::get('seeker',['as' => 'seeker', 'uses' => 'ProjectController@seekerView']);
    Route::get('seeker', ['as' => 'seeker', 'uses' => 'ProjectController@getProjects']);
    Route::post('seeker', ['uses' => 'ProjectController@create']);
});
