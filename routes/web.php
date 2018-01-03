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
Route::post('reset', 'ResetController@postReset')->name('password.request');
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
    Route::get('seeker/projects', ['as' => 'projects', 'uses' => 'ProjectController@myProjects']);
    Route::patch('seeker/projects/{id}', ['as' => 'updateproject', 'uses' => 'ProjectController@updateProject']);
    Route::get('seeker', ['as' => 'seeker', 'uses' => 'ProjectController@recentProjects']);
    Route::post('seeker', ['uses' => 'ProjectController@create']);
   
   /* Route::get('seeker/profile', function(){
        return view('userprofiles/seeker');
    });*/
    Route::get('seeker/profile/{id}', ['as' => 'profile', 'uses' => 'SeekerController@seekerProfile']);
    Route::post('seeker/profile/{id}', ['uses' => 'SeekerController@updatePassword']);
    Route::patch('seeker/profile/{id}', [ 'uses' => 'SeekerController@updateProfile']);
    Route::patch('seeker/avatar/{id}', ['as' => 'avatar', 'uses' => 'SeekerController@updateAvatar']);

    //bidder
    Route::get('bidder', ['as' => 'bidder', 'uses' => 'ProjectCOntroller@getProjectsBidder']);
    Route::get('bidder/profile/{id}', ['as' => 'bidderprofile', 'uses' => 'BidderController@bidderProfile']);
    Route::get('bidder/inbox', function(){
        return view('inbox/bidder');
    });
});
