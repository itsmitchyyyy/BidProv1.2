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
// Route::get('test', function(){
//     event(new \App\Events\BidNotified('aw','placed a bid on aw' ,"/uploads/blank.png", "route('projects')"));
      
//     return 'Notified';
// });
// MOBILE
 // MOBILE
 Route::get('mobilelogin', function(){
    return view('mobile/login');
})->name('mobile.login');
Route::post('mobilelogin', 'MobileController@login');
Route::get('mobilelogout', 'MobileController@logout')->name('mobile.logout');
Route::get('seekerhome', 'MobileController@seekerHome')->name('seeker.home');
Route::get('bidderhome', 'MobileController@bidderHome')->name('bidder.home');
/* Route::get('bidderprofile', ['as' => 'bidder.profile', function(){
    return view('mobile/bidder/profile');
}]); */
Route::get('bidderprofile', function(){
    return view('mobile/bidder/profile');
})->name('bidder.profile');
Route::get('seekerprofile', function(){
    return view('mobile/seeker/profile');
})->name('seeker.profile');
/* Route::get('seekerprofile', ['as' => 'seeker.profile', function(){
    return view('mobile/seeker/profile');
}]); */
Route::get('seekerprojects', 'MobileController@getProjects')->name('seeker.projects');
/* Route::get('seekerprojects', function(){
    return view('mobile/seeker/project');
})->name('seeker.projects'); */
/* Route::get('seekerprojects',['as' => 'seeker.projects', function(){
    return view('mobile/seeker/projects');
}]); */
Route::get('bidderprojects', 'MobileController@getBProjects')->name('bidder.projects');
Route::patch('bidderprofile/update/avatar/{id}', ['as' => 'bidder.profile.avatar', 'uses' => 'MobileController@updateBAvatar']);
// END OF MOBILE
// END MOBILE


Route::get('/', function () {
    return view('home');
})->name('landing');
Route::get('commission', 'AdminController@monthlyCommision')->name('admin.commission');
/* Route::get('testing', function(){
    return view('ongoing/seeker');
})->name('testing'); */
// Route::get('test/{project_id}/{user_id}/{proposal_id}', 'ProjectController@proposalModules');
// Route::get('ratings', function(){
//     return view('ratings/seeker');
// });
// Route::get('ratings', 'RatingController@viewUser')->name('rate');
// MOBILE
// Route::post('loginmobile', 'MobileController@login')->name('mobile.login');
// Route::post('ratingmobile', 'MobileController@userRatings')->name('mobile.ratings');
// END OF MOBILE
Route::get('seeker/400', function(){
    return view('page/seeker');
})->name('seeker.expired');
// START
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

    Route::get('list/projects', ['as' => 'projects.list', 'uses' => 'AdminController@openProjects']);
    Route::get('bidder/user/reports', ['as' => 'user.report.list', 'uses' => 'ReportController@getReports']);
    Route::post('bidder/user/report', ['as' => 'user.report', 'uses' => 'ReportController@getReport']);
    Route::post('bidder/user/report/update', ['as' => 'user.report.update', 'uses' => 'ReportController@updateReport']);
    Route::get('list/bidder', ['as' => 'bidderAdmin', 'uses' => 'BidderController@getRole']);
    Route::get('list/seeker', ['as' => 'adminSeeker', 'uses' => 'SeekerController@getRole']);
    Route::get('calendar', ['as' => 'calendarAdmin', function(){
        return view('admin/calendar');
    }]);
    Route::get('list/post', ['as' => 'postAdmin', function(){
        return view('admin/post');
    }]);
    Route::get('lists/presentation', ['as' => 'presentation.lists', 'uses' => 'AdminController@presentationReports']);
    Route::post('list/bidder/deactivate',['as' => 'user.deactivate', 'uses' => 'AdminController@deactivateUser']);
    Route::post('list/bidder/activate',['as' => 'user.activate', 'uses' => 'AdminController@activateUser']);
    Route::get('list/bidder/users', ['as' => 'users.profile', 'uses' => 'AdminController@viewUser']);
    Route::get('lists/projects/monthly', ['as' => 'projects.monthly', 'uses' => 'AdminController@monthlyProjects']);
    // end admin
    //seeker
    Route::get('seeker/projects', ['as' => 'projects', 'uses' => 'ProjectController@myProjects']);
    //Route::get('seeker/projects', ['uses' => 'ProjectController@closedProjects']);
    Route::post('seeker/projects/repost/{id}',['as' => 'repostproject', 'uses' => 'ProjectController@openProject']);
    Route::patch('seeker/projects/update/{id}', ['as' => 'closeproject', 'uses' => 'ProjectController@closeProject']);
    Route::patch('seeker/projects/{id}', ['as' => 'updateproject', 'uses' => 'ProjectController@updateProject']);
    // Route::post('/seeker/projects/paypal', ['as' => 'deleteproject', 'uses' => 'ProjectController@deleteProject']);
    Route::get('seeker', ['as' => 'seeker', 'uses' => 'ProjectController@recentProjects']);
    Route::post('seeker', ['uses' => 'ProjectController@create']);
    // Route::get('/seeker/projects/paypal', ['as' => 'projects.status', 'uses' => 'ProjectController@paymentStatus']);
   /* Route::get('seeker/profile', function(){
        return view('userprofiles/seeker');
    });*/
    Route::get('seeker/profile/{id}', ['as' => 'profile', 'uses' => 'SeekerController@seekerProfile']);
    Route::post('seeker/profile/{id}', ['uses' => 'SeekerController@updatePassword']);
    Route::patch('seeker/profile/{id}', [ 'uses' => 'SeekerController@updateProfile']);
    Route::patch('seeker/avatar/{id}', ['as' => 'seekavatar', 'uses' => 'SeekerController@updateAvatar']);
    Route::get('seeker/notifications', ['as' => 'viewNotification', 'uses' => 'NotificationController@viewNotification']);
    Route::post('seeker/notifications/update/{notif_id}', ['as' => 'updateNotification', 'uses' => 'NotificationController@updateNotification']);
    Route::get('view/{id}', ['as' => 'myProject', 'uses' => 'ProjectController@getMyProject']);
    Route::get('seeker/proposal/details/{project_id}/{user_id}/{proposal_id}', ['as' => 'viewBids', 'uses' => 'ProjectController@ProposalModules']);
    Route::get('seeker/proposal/accept/{seeker_id}/{bidder_id}/{proposal_id}/{project_id}', ['as' => 'acceptBid', 'uses' => 'ProjectController@acceptBid']);
    Route::patch('/seeker/projects/cancel/paypal/{id}/{bid_id}/{project_name}/{user_paypal}', ['as' => 'cancelProject', 'uses' => 'BidController@cancelProject']);
    Route::get('/seeker/projects/paypal', ['as' => 'cancelprojects.status', 'uses' => 'BidController@paymentStatus']);
    Route::get('seeker/view/bid/{module_id}', ['as' => 'viewModule', 'uses' => 'ModuleController@proposalModules']);
    Route::get('seeker/view/project/bid/{proposal_id}/{seeker_id}/{project_id}', ['as' => 'acceptedBid', 'uses' => 'ModuleController@getModule']);
    Route::post('seeker/view/project/bid/comment/post', ['as' => 'postComment','uses' => 'ModuleController@addComment']);
    Route::get('seeker/view/bid/module/{module_id}', ['as' => 'viewComments', 'uses' => 'ModuleController@moduleComments']);
    Route::get('seeker/ratings/{id}', ['as' => 'rate.show', 'uses' => 'RatingController@reviewUser']);
    Route::post('seeker/ratings',['as' => 'rate.post', 'uses' => 'RatingController@postReview']);
    Route::post('seeker/ratings/update', ['as' => 'rate.comment', 'uses' => 'RatingController@updateComment']);
    Route::get('seeker/view/user/profile/{user_id}', ['as' => 'viewUser', 'uses' => 'SeekerController@viewUser']);
    Route::get('seeker/presentation/update/{status}/{project_id}/{user_id}/{price}', ['as' => 'presentation.update.seeker', 'uses' => 'PresentationController@seekerUpdate']);
    // PAYMENT
    Route::patch('seeker/view/project/bid/paypal/{id}/{bid_id}/{project_name}/{user_paypal}/{amount}/{user_id}', ['as' => 'payment', 'uses' => 'ModuleController@payProject']);
    Route::get('seeker/view/project/bid/paypal', ['as' => 'payment.status','uses' => 'ModuleController@paymentStatus']);
    // END
    Route::post('seeker/view/project/bid/transaction/{project_id}', ['as' => 'transaction.status', 'uses' => 'ModuleController@checkPayment']);
    // end seeker
    //bidder
    // MAIN PAGE BIDDER
    Route::get('bidder', ['as' => 'bidder', 'uses' => 'ProjectController@getProjectsBidder']);
    Route::get('bidder/works',['as' => 'bidderworks','uses' => 'BidderController@viewWorks']);
    // END
    // PROFILE
    Route::get('bidder/profile/{id}', ['as' => 'bidderprofile', 'uses' => 'BidderController@bidderProfile']);
    Route::post('bidder/profile/{id}', ['uses' => 'BidderController@updatePassword']);
    Route::patch('bidder/profile/{id}', [ 'uses' => 'BidderController@updateProfile']);
    Route::patch('bidder/avatar/{id}', ['as' => 'avatar', 'uses' => 'BidderController@updateAvatar']);
    Route::patch('bidder/skills/{id}', ['as' => 'skills', 'uses' => 'BidderController@addSkills']);
    Route::post('bidder/view/project/bid/comment/post', ['as' => 'postCommentBidder','uses' => 'ModuleController@addCommentBidder']);
    Route::get('bidder/view/user/profile/{user_id}', ['as' => 'viewBuser', 'uses' => 'BidderController@viewUser']);
    Route::get('bidder/view/proposals/edit/{id}/{proposal_id}',['as' => 'edit.proposal', 'uses' => 'BidderController@showProposals']);
    Route::patch('bidder/view/proposals/update/{proposal_id}/{project_id}',['as' => 'update.proposal', 'uses' => 'BidderController@updateProposal']);
    // Route::get('bidder/notify/payment/{bidder_id}', ['as' => 'notify.bidder.payment', 'uses' => 'PresentationController@notifyBidder']);
    // END
    // Route::get('skills',  ['uses' => 'BidderController@getSkills']);
    // Route::get('bidder/inbox', function(){
    //     return view('inbox/bidder');
    // }); 
    // Route::get('bidder/inbox-detail', function(){
    //     return view('inbox/inbox-detail');
    // });
    // VIEW PROject
    Route::get('project/{id}', ['as' => 'viewProject', 'uses' => 'ProjectController@viewProject']);
    Route::get('project/proposal/{id}', ['as' => 'proposal', 'uses' => 'ProjectController@proposalDetails']);
    Route::post('propose/{project_id}/{user_id}', ['as' => 'proposetome', 'uses' => 'ProjectController@proposeProject']);
    // END
    // PROPOSAL
    Route::get('proposals', ['as' => 'bids', 'uses' => 'ProposalController@viewProposals']);
    Route::delete('proposals', ['uses' => 'ProposalController@cancelProposal']);
    // END
    //WORKS
    Route::get('bidder/view/project/bid/{proposal_id}/{bidder_id}/{project_id}', ['as' => 'myWorks', 'uses' => 'ModuleController@biddergetModule']);
    Route::post('bidder/view/project/bid/update/{module_id}/{projetc_id}',['as' => 'updateModule', 'uses' => 'ModuleController@updateModules']);
    Route::post('bidder/view/project/bid/comment/post', ['as' => 'postCommentBidder','uses' => 'ModuleController@addCommentBidder']);
    Route::post('bidder/view/project/bid/update/module/{propose_moduleID}/{propose_moduleStatus}/{module_percent}/{module_id}',['as' => 'moduleUpdate', 'uses' => 'ModuleController@moduleUpdate']);
    Route::post('bidder/view/project/bid/update/files', ['as' => 'moduleFiles', 'uses' => 'ModuleController@addFiles']);
    Route::post('bidder/view/project/bid/zip/files', ['as' => 'downloadFiles', 'uses' => 'ModuleController@zipFile']);
    Route::get('bidder/notifications', ['as' => 'viewBNotification', 'uses' => 'NotificationController@viewBNotification']);
    Route::get('bidder/ratings/{id}', ['as' => 'rate.seeker', 'uses' => 'RatingController@reviewBUser']);
    Route::post('bidder/ratings',['as' => 'rate.postseeker', 'uses' => 'RatingController@postBReview']);
    Route::post('bidder/project/send-email', ['as' => 'send-email', 'uses' => 'ModuleController@sendMail']);
    Route::get('bidder/presentation/update/{status}/{project_id}/{user_id}/{price}', ['as' => 'presentation.update', 'uses' => 'PresentationController@bidderUpdate']);
    // END works    
    /* Route::get('view-email', function(){
        return view('email/seeker');
    }); */

    
    Route::post('seeker/report/post',['as' => 'post.seeker', 'uses' => 'ReportController@postReport']);

   
});
