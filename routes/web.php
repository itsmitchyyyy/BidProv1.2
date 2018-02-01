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
/* Route::get('test', function(){
    event(new App\Events\BidNotified('Someone','test','test','test'));
    return 'Notified';
}); */

Route::get('/', function () {
    return view('home');
});
// Route::get('test/{project_id}/{user_id}/{proposal_id}', 'ProjectController@proposalModules');
// Route::get('ratings', function(){
//     return view('ratings/seeker');
// });
Route::get('ratings', 'RatingController@viewUser')->name('rate');


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
    //Route::get('seeker/projects', ['uses' => 'ProjectController@closedProjects']);
    Route::patch('seeker/projects/repost/{id}',['as' => 'repostproject', 'uses' => 'ProjectController@openProject']);
    Route::patch('seeker/projects/update/{id}', ['as' => 'closeproject', 'uses' => 'ProjectController@closeProject']);
    Route::patch('seeker/projects/{id}', ['as' => 'updateproject', 'uses' => 'ProjectController@updateProject']);
    Route::post('/seeker/projects/paypal', ['as' => 'deleteproject', 'uses' => 'ProjectController@deleteProject']);
    Route::get('seeker', ['as' => 'seeker', 'uses' => 'ProjectController@recentProjects']);
    Route::post('seeker', ['uses' => 'ProjectController@create']);
    Route::get('/seeker/projects/paypal', ['as' => 'projects.status', 'uses' => 'ProjectController@paymentStatus']);
   /* Route::get('seeker/profile', function(){
        return view('userprofiles/seeker');
    });*/
    Route::get('seeker/profile/{id}', ['as' => 'profile', 'uses' => 'SeekerController@seekerProfile']);
    Route::post('seeker/profile/{id}', ['uses' => 'SeekerController@updatePassword']);
    Route::patch('seeker/profile/{id}', [ 'uses' => 'SeekerController@updateProfile']);
    Route::patch('seeker/avatar/{id}', ['as' => 'seekavatar', 'uses' => 'SeekerController@updateAvatar']);
    Route::get('seeker/notifications', ['as' => 'viewNotification', 'uses' => 'NotificationController@viewNotification']);
    Route::get('view/{id}', ['as' => 'myProject', 'uses' => 'ProjectController@getMyProject']);
    Route::get('seeker/proposal/details/{project_id}/{user_id}/{proposal_id}', ['as' => 'viewBids', 'uses' => 'ProjectController@ProposalModules']);

    //bidder
    Route::get('bidder', ['as' => 'bidder', 'uses' => 'ProjectController@getProjectsBidder']);
    Route::get('bidder/profile/{id}', ['as' => 'bidderprofile', 'uses' => 'BidderController@bidderProfile']);
    Route::post('bidder/profile/{id}', ['uses' => 'BidderController@updatePassword']);
    Route::patch('bidder/profile/{id}', [ 'uses' => 'BidderController@updateProfile']);
    Route::patch('bidder/avatar/{id}', ['as' => 'avatar', 'uses' => 'BidderController@updateAvatar']);
    Route::patch('bidder/skills/{id}', ['as' => 'skills', 'uses' => 'BidderController@addSkills']);
    // Route::get('skills',  ['uses' => 'BidderController@getSkills']);
    Route::get('bidder/inbox', function(){
        return view('inbox/bidder');
    }); 
    Route::get('bidder/inbox-detail', function(){
        return view('inbox/inbox-detail');
    });
    Route::get('project/{id}', ['as' => 'viewProject', 'uses' => 'ProjectController@viewProject']);
    Route::get('project/proposal/{id}', ['as' => 'proposal', 'uses' => 'ProjectController@proposalDetails']);
    Route::post('propose/{project_id}/{user_id}', ['as' => 'proposetome', 'uses' => 'ProjectController@proposeProject']);
    
    Route::get('proposals', ['as' => 'bids', 'uses' => 'ProposalController@viewProposals']);
    Route::delete('proposals', ['uses' => 'ProposalController@cancelProposal']);

    //ratings
    Route::post('ratings', 'RatingController@postReview')->name('rate.post');
    Route::get('ratings/{id}', 'RatingController@reviewUser')->name('rate.show');
});
