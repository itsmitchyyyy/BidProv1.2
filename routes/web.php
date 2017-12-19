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
Route::get('email', 'ResetController@showReset')->name('password.email');
Route::post('email', 'ResetController@sendEmail');
Route::get('logout', 'LoginController@logout')->name('logout');
Route::get('register', 'RegisterController@registerForm')->name('register');
Route::post('register', 'RegisterController@register');
Route::get('reset/{token}' ,'ResetController@getReset')->name('password.reset');
Route::post('reset', 'RestController@postReset')->name('password.request');
Route::group(['middleware' => ['auth']], function(){

    //admin
    Route::get('admin/dashboard', ['as' => 'admin', function(){
        return view('admin/admin');
    }]);
    Route::get('list/bidder', ['as' => 'bidderAdmin', 'uses' => 'BidderController@getRole']);
    Route::get('list/seeker', ['as' => 'adminSeeker', 'uses' => 'SeekerController@getRole']);
    Route::get('calendar', ['as' => 'calendarAdmin', function(){
        return view('admin/calendar');
    }]);
    Route::get('list/post', ['as' => 'postAdmin', function(){
        return view('admin/post');
    }]);
    //seeker
    Route::get('seeker', ['as' => 'seeker', 'uses' => 'ProjectController@getProjects']);
    Route::post('seeker', ['uses' => 'ProjectController@create']);
    Route::get('seeker/profile', function(){
        return view('userprofiles/seeker');
    });
});
