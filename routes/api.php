<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\JobApiController; 
use App\Http\Controllers\Api\V1\EventController; 
use App\Http\Controllers\Api\V1\TalentController; 
use App\Http\Controllers\Api\V1\ProfileController; 

//talent
use App\Http\Controllers\Api\V1\Talent\TalentAuthController;

//Organisation
use App\Http\Controllers\Api\V1\Talent\OrganisationController;

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
// Route::get('/controller', function() {
//     $exitCode = Artisan::call('make:controller Api/V1/Talent/TalentAuthController');
//     return 'DONE'; //Return anything
// });
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->group(function () {
    Route::post('getalljobs',[JobApiController::class,'getalljobs']);
    Route::post('getsinglejobs',[JobApiController::class,'getsinglejobs']);
    Route::post('dashboardjobs',[JobApiController::class,'dashboardjobs']);
    
    Route::post('sliders',[EventController::class,'sliders']);
    Route::post('getallevents',[EventController::class,'getallevents']);
    Route::post('dashboardevent',[EventController::class,'dashboardevent']);
    
    Route::post('dashboardfeaturet',[TalentController::class,'dashboardfeaturet']);
    Route::post('dashboardmembert',[TalentController::class,'dashboardmembert']);
    
    Route::post('allfeaturetalent',[TalentController::class,'allfeaturetalent']);
    Route::post('allmembertalent',[TalentController::class,'allmembertalent']);
    Route::post('getsingletalent',[TalentController::class,'getsingletalent']);
    /////profile /////
    Route::post('user/dashboard',[ProfileController::class,'userdashboard']);
    
    Route::post('update_talent_social_media',[TalentController::class,'update_talent_social_media']);
    
    Route::post('getprofiledata',[ProfileController::class,'getprofiledata']);
    Route::post('/updateprofiledata',[ProfileController::class,'updateprofiledata']);
    
    //gallery
    Route::post('uploadimage',[TalentAuthController::class,'uploadimage']);
    Route::post('gallerydelete',[TalentAuthController::class,'gallerydelete']);
    
    
    //video
    Route::post('uploadvideo',[TalentAuthController::class,'uploadvideo']);
    Route::post('videodelete',[TalentAuthController::class,'videodelete']);
    
    Route::post('updateuploadvideo',[TalentAuthController::class,'updateuploadvideo']);
        
    //telent login
    Route::post('talent/register',[TalentAuthController::class,'talent_register']);
    Route::post('talent/login',[TalentAuthController::class,'talent_login']);
    Route::post('getsingaltalent',[TalentAuthController::class,'getsingaltalent']);
    Route::post('gettalentvideolist',[TalentAuthController::class,'gettalentvideolist']);
    Route::post('gettalentimageslist',[TalentAuthController::class,'gettalentimageslist']);
    Route::post('gettalentsociallink',[TalentAuthController::class,'gettalentsociallink']);
    Route::post('gettalentappliedjobs',[TalentAuthController::class,'gettalentappliedjobs']);
    Route::post('talentchangepassword',[TalentAuthController::class,'talentchangepassword']);
    Route::post('updatetalentprofile',[TalentAuthController::class,'updatetalentprofile']);
    
    //state
    Route::post('getallstate',[TalentAuthController::class,'getallstate']);
    Route::post('getallcitybystateID',[TalentAuthController::class,'getallcitybystateID']);
    
    //category
    Route::post('getalllanguage',[TalentAuthController::class,'getalllanguage']);
    
    //category
    Route::post('getallcategory',[TalentAuthController::class,'getallcategory']);
    Route::post('getallsubcatbycatID',[TalentAuthController::class,'getallsubcatbycatID']);
    
    
    //social link
    Route::post('uploadsocialmedialink',[TalentAuthController::class,'uploadsocialmedialink']);
    
    //job List
    Route::post('joblist',[TalentAuthController::class,'joblist']);
    
    //change password
    Route::post('profilechangepassword',[TalentAuthController::class,'profilechangepassword']);
    
    
    
    //Organisation
    
        Route::post('orggetporfiledata',[OrganisationController::class,'orggetporfiledata']);
        
        //representer
        Route::post('getrepresenter',[OrganisationController::class,'getrepresenter']);
         
        //joblist
        Route::post('orggetjobposts',[OrganisationController::class,'orggetjobposts']);
        Route::post('orggetjobsingleposts',[OrganisationController::class,'orggetjobsingleposts']);
        
        //eventlist
        Route::post('orggeteventposts',[OrganisationController::class,'orggeteventposts']);
        Route::post('orgsinglegeteventposts',[OrganisationController::class,'orgsinglegeteventposts']);
        
        //Movielist
        Route::post('orggetmovieposts',[OrganisationController::class,'orggetmovieposts']);
        
        //course offered
        Route::post('orggetcourseoffered',[OrganisationController::class,'orggetcourseoffered']);
    
        //gellery
        Route::post('orggetgallery',[OrganisationController::class,'orggetgallery']);
        
        //video
        Route::post('orggetvideos',[OrganisationController::class,'orggetvideos']);
        
        //Change_Password
        Route::post('orgchangepasswordprocess',[OrganisationController::class,'orggetchangepasswordprocess']);
        
        //updateprofile
        Route::post('orgupdateprofile',[OrganisationController::class,'orgupdateprofile']);
         
        //updateprofile
        Route::post('orgupdatejob',[OrganisationController::class,'orgupdatejob']);
        Route::post('orginsertjob',[OrganisationController::class,'orginsertjob']);
        
        //updateevent
        Route::post('orgupdateevent',[OrganisationController::class,'orgupdateevent']);
        Route::post('orginsertevent',[OrganisationController::class,'orginsertevent']);
        
        //updatemovie
        Route::post('orgupdatemovie',[OrganisationController::class,'orgupdatemovie']);
        Route::post('orginsertmovie',[OrganisationController::class,'orginsertmovie']);
        Route::post('orggetsinglemovie',[OrganisationController::class,'orggetsinglemovie']);
            
        //updatecourses
        Route::post('orgupdatecource',[OrganisationController::class,'orgupdatecource']);
        Route::post('orgaddcourse',[OrganisationController::class,'orgaddcourse']);
        
        //updategallery
        Route::post('orgupdategallery',[OrganisationController::class,'orgupdategallery']);
        
        //update and insert video
        Route::post('orgupdatevideos',[OrganisationController::class,'orgupdatevideos']);
        Route::post('orginsertvideos',[OrganisationController::class,'orginsertvideos']);
});