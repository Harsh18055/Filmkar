<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\RepresenterController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\EventCategoryController;
use App\Http\Controllers\Admin\InstitutesController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\pagesController; 
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ReferralController; 
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\EventController;
use App\Http\Controllers\Front\MovieController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\OrganisationController;
use App\Http\Controllers\Front\InstituteController; 
use App\Http\Controllers\Front\GalleryController; 
use App\Http\Controllers\Admin\ContactController; 
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Admin\SliderController;
// use Mail;


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
Route::get('/clear', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
Route::get('/controller', function() {
    $exitCode = Artisan::call('make:controller Api/V1/Talent/TalentAuthController');
    return 'DONE'; //Return anything
});
Route::get('/email', function () {
    $message = "Hello";

   Mail::send([], [], function ($message) {
    $message->to('aryanzyraj@gmail.com')
            ->subject('Hello Email')
            ->setBody('Hello', 'text/plain');
});


    return 'Email sent successfully!';
});


Route::get('/mail', function() {
    $exitCode = Artisan::call('make:mail Eventapprovalmail');
    return 'DONE'; //Return anything
});
Route::post('admin/uploader/',[BlogController::class,'uploader'])->name('ckeditor.upload');

//contact us
Route::post('contact/submit',[ContactController::class,'contact_process'])->name('contact.submit');

Route::post('create',[AdminController::class,'create'])->name('create.admins');
Route::get('admin',[AdminController::class,'index']);
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');

Route::group(['middleware'=>'admin_auth'],function(){
Route::get('admin/dashboard',[AdminController::class,'dashboard']);

// state
Route::get('admin/state',[StateController::class,'index']);
Route::get('admin/state/manage_state',[StateController::class,'manage_state']);
Route::get('admin/state/manage_state/{id}',[StateController::class,'manage_state']);
Route::post('admin/state/manage_state_process',[StateController::class,'manage_state_process'])->name('state.manage_state_process');
Route::get('admin/state/delete/{id}',[StateController::class,'delete']);

// city
Route::get('admin/city',[CityController::class,'index']);
Route::get('admin/city/manage_city',[CityController::class,'manage_city']);
Route::get('admin/city/manage_city/{id}',[CityController::class,'manage_city']);
Route::post('admin/city/manage_city_process',[CityController::class,'manage_city_process'])->name('city.manage_city_process');
Route::get('admin/city/delete/{id}',[CityController::class,'delete']);

// language
Route::get('admin/language',[LanguageController::class,'index']);
Route::get('admin/language/manage_language',[LanguageController::class,'manage_language']);
Route::get('admin/language/manage_language/{id}',[LanguageController::class,'manage_language']);
Route::post('admin/language/manage_language_process',[LanguageController::class,'manage_language_process'])->name('language.manage_language_process');
Route::get('admin/language/delete/{id}',[LanguageController::class,'delete']);
Route::get('admin/language/status/{status}/{id}',[LanguageController::class,'status']);
// language

// Slider Start
Route::get('admin/slider',[SliderController::class,'slider']);
Route::post('admin/slider',[SliderController::class,'store'])->name('slider');
// Slider End

// category
Route::get('admin/category',[CategoryController::class,'index']);
Route::get('admin/subcategory',[CategoryController::class,'subcat_index']);
Route::get('admin/category/manage_category',[CategoryController::class,'manage_category']);
Route::get('admin/category/manage_category/{id}',[CategoryController::class,'manage_category']);
Route::post('admin/category/manage_category_process',[CategoryController::class,'manage_category_process'])->name('category.manage_category_process');
Route::get('admin/category/delete/{id}',[CategoryController::class,'delete']);
Route::get('admin/category/status/{status}/{id}',[CategoryController::class,'status']);
Route::get('admin/category/is_attr/{is_attr}/{id}',[CategoryController::class,'is_attr']);
// category

// event category
Route::get('admin/event_category',[EventCategoryController::class,'index']);
Route::get('admin/event_category/manage_event_category',[EventCategoryController::class,'manage_event_category']);
Route::get('admin/event_category/manage_event_category/{id}',[EventCategoryController::class,'manage_event_category']);
Route::post('admin/event_category/manage_event_category_process',[EventCategoryController::class,'manage_event_category_process'])->name('event.manage_event_category_process');
Route::get('admin/event_category/delete/{id}',[EventCategoryController::class,'delete_category']);
Route::get('admin/event_category/status/{status}/{id}',[EventCategoryController::class,'status']);
// event category


//pages
Route::get('admin/pages',[pagesController::class,'index'])->name('pages');
Route::post('admin/pages_process',[pagesController::class,'pages_process'])->name('pages.update');

//pages

//banner
Route::get('admin/banner',[BannerController::class,'banner'])->name('banner');
Route::get('admin/manage_banner',[BannerController::class,'manage_banner']);
Route::get('admin/manage_banner/{id}',[BannerController::class,'manage_banner']);
Route::post('admin/manage_banner_process',[BannerController::class,'manage_banner_process'])->name('manage_banner_process');
Route::get('admin/banner/status/{status}/{id}',[BannerController::class,'status']);
//banner


//chatbot

Route::get('admin/chatbot',[SettingController::class,'chatbot'])->name('index');
Route::get('admin/chatbot/manage_chatbot',[SettingController::class,'manage_chatbot'])->name('admin.manage_chatbot.add');
Route::get('admin/chatbot/manage_chatbot/{id}',[SettingController::class,'manage_chatbot']);
Route::post('admin/chatbot/manage_chatbot_process',[SettingController::class,'manage_chatbot_process'])->name('chatbot.manage_chatbot_process');
Route::get('admin/chatbot/delete/{id}',[SettingController::class,'delete']);
Route::get('admin/chatbot/status/{status}/{id}',[SettingController::class,'status']);




//admin
Route::get('admin/admins',[AdminController::class,'admins'])->name('admins');
Route::get('admin/manage_admins',[AdminController::class,'manage_admins']);
Route::get('admin/manage_admins/{id}',[AdminController::class,'manage_admins']);
Route::post('admin/manage_admins_process',[AdminController::class,'manage_admins_process'])->name('manage_admins_process');
Route::get('admin/delete/{id}',[AdminController::class,'admindelete']);
//admin

// blog
Route::get('admin/blog',[BlogController::class,'index']);
Route::get('admin/blog/manage_blog',[BlogController::class,'manage_blog']);
Route::get('admin/blog/manage_blog/{id}',[BlogController::class,'manage_blog']);
Route::post('admin/blog/manage_blog_process',[BlogController::class,'manage_blog_process'])->name('blog.manage_blog_process');
Route::get('admin/blog/delete/{id}',[BlogController::class,'delete']);
Route::get('admin/blog/status/{status}/{id}',[BlogController::class,'status']);
Route::get('admin/blog/isfeatured/{isfeatured}/{id}',[BlogController::class,'isfeatured']);
// blog

//job posts
Route::get('admin/job_posts',[JobController::class,'job_posts']);
Route::get('admin/job_posts/view_job/{id}',[JobController::class,'view_job']);
Route::get('admin/job_posts/is_approved/{is_approved}/{id}',[JobController::class,'is_approved']);
Route::get('admin/job_posts/isfeatured/{isfeatured}/{id}',[JobController::class,'isfeatured']);
//job posts

// blog
Route::get('admin/representer',[RepresenterController::class,'index']);
Route::get('admin/representer/manage_representer',[RepresenterController::class,'manage_representer']);
Route::get('admin/representer/manage_representer/{id}',[RepresenterController::class,'manage_representer']);
Route::post('admin/representer/manage_representer_process',[RepresenterController::class,'manage_representer_process'])->name('representer.manage_representer_process');
Route::get('admin/representer/delete/{id}',[RepresenterController::class,'delete']);
Route::get('admin/representer/status/{status}/{id}',[RepresenterController::class,'status']);
// blog

// pending
Route::get('admin/users/pending',[AdminController::class,'pending_users'])->name('users.pending');
Route::get('admin/users/status/{status}/{id}',[AdminController::class,'userstatus']);
Route::get('admin/users/delete/{id}',[AdminController::class,'delete_user']);
Route::get('admin/users/details/{id}',[AdminController::class,'userdetails']);
// pending

// approved
Route::get('admin/users/approved',[AdminController::class,'approved_users'])->name('users.approved');
Route::get('admin/users/isfeatured/{isfeatured}/{id}',[AdminController::class,'isfeatured'])->name('users.isfeatured');
// approved

// pending
Route::get('admin/organize/pending',[AdminController::class,'pending_organize'])->name('organize.pending');
Route::get('admin/organize/is_approved/{is_approved}/{id}',[AdminController::class,'organizestatus']);
Route::get('admin/organize/delete/{id}',[AdminController::class,'delete_organize']);
Route::get('admin/organize/details/{id}',[AdminController::class,'organizedetails']);
// pending

// approved
Route::get('admin/organize/approved',[AdminController::class,'approved_organize'])->name('organize.approved');
Route::get('admin/organize/isfeatured/{isfeatured}/{id}',[AdminController::class,'organize_isfeatured'])->name('organize.isfeatured');
// approved

Route::get('admin/event/approved',[EventCategoryController::class,'event']);
Route::get('admin/event/pending',[EventCategoryController::class,'event']);
Route::get('admin/event/delete/{id}',[EventCategoryController::class,'delete_event']);
Route::get('admin/event/view_event/{id}',[EventCategoryController::class,'view_event']);
Route::get('admin/event/is_approved/{is_approved}/{id}',[EventCategoryController::class,'is_approved']);
Route::get('admin/event/isfeatured/{isfeatured}/{id}',[EventCategoryController::class,'isfeatured']);

Route::get('admin/moive/pending',[InstitutesController::class,'institute']);
Route::get('admin/moive/approved',[InstitutesController::class,'institute']);
Route::get('admin/moive/view_institute/{id}',[InstitutesController::class,'view_institute']);
Route::get('admin/moive/is_approved/{is_approved}/{id}',[InstitutesController::class,'is_approved']);
Route::get('admin/moive/isfeatured/{isfeatured}/{id}',[InstitutesController::class,'isfeatured']);

Route::get('admin/setting',[SettingController::class,'setting']);
Route::post('admin/setting/manage_setting_process',[SettingController::class,'manage_setting_process'])->name('setting.manage_setting_process');
Route::post('admin/setting/manage_points',[SettingController::class,'manage_points'])->name('setting.manage_points');

Route::get('admin/jobs/sendnoti/{cat_id}',[SettingController::class,'sendnewjobnoti'])->name('setting.manage_newjob_notification');

Route::get('admin/logout', function () {
    session()->forget('ADMIN_LOGIN');
    session()->forget('ADMIN_ID');
    session()->flash('error','Logout sucessfully');
    return redirect('admin');
});
});


Route::post('checklogintelent',[UserController::class,'checklogintelent'])->name('user.checklogintelent');
Route::post('checkloginorganize',[UserController::class,'checkloginorganize'])->name('user.checkloginorganize');
Route::post('telentforgotpassword',[UserController::class,'telentforgotpassword'])->name('user.telentforgotpassword');
Route::post('organizeforgotpassword',[UserController::class,'organizeforgotpassword'])->name('user.organizeforgotpassword');

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/getreplay/{id}',[HomeController::class,'getreplay'])->name('getreplay');
Route::get('/privacy-policy',[pagesController::class,'privacypolicy'])->name('pages.privacypolicy');
Route::get('/about-us',[pagesController::class,'aboutus'])->name('pages.aboutus');
Route::get('/terms-and-conditions',[pagesController::class,'terms_and_conditions'])->name('pages.terms_and_conditions');
Route::post('subscribe',[HomeController::class,'subscribe'])->name('subscribe');

Route::get('/contact',[HomeController::class,'contact'])->name('contact');
Route::get('/category/{slug}',[HomeController::class,'details'])->name('details');
Route::get('talent/browse/',[HomeController::class,'talent_browse'])->name('talent.browse');
Route::get('filterusers/',[HomeController::class,'filterusers'])->name('filterusers');
Route::get('/blog',[HomeController::class,'blog'])->name('blog');
Route::get('/discussion',[HomeController::class,'discussion'])->name('discussion');
Route::get('categories',[HomeController::class,'categories'])->name('categories');
Route::get('/events',[HomeController::class,'events'])->name('events');
Route::get('/events/details/{slug}',[HomeController::class,'event_detail'])->name('events.details');
Route::get('events/search',[HomeController::class,'event_search'])->name('events.search');

Route::get('/movie_details2', function () {
  
    return view('front/movie_details2');
});

 
// Route::get('/movie_details2',[HomeController::class,'movie_details2'])->name('movie_details2');
// Route::get('/movies/details2/{slug}',[HomeController::class,'movie_detail2'])->name('movies.details2');
Route::get('/movies2',[HomeController::class,'movies2'])->name('movies2');
Route::get('/movies2/details/{slug}',[HomeController::class,'movie_detail'])->name('movies2.details');
Route::get('movies2/search',[HomeController::class,'movie_search2'])->name('movies2.search');
Route::get('/movies',[HomeController::class,'movies'])->name('movies');
Route::get('/movies/details/{slug}',[HomeController::class,'movie_detail'])->name('movies.details');
Route::get('movies/search',[HomeController::class,'movie_search'])->name('movies.search');
Route::post('checkratting',[HomeController::class,'checkratting'])->name('movie.ratting');
Route::post('checkuserratting',[HomeController::class,'checkuserratting'])->name('user.ratting');
Route::post('ratting',[HomeController::class,'ratting'])->name('movie.rattingform');
Route::post('rattingeditform',[HomeController::class,'rattingeditform'])->name('user.rattingeditform');
Route::post('userratting',[HomeController::class,'userratting'])->name('user.rattingform');
Route::get('get-review', [HomeController::class, 'getReview'])->name('user.get-review');
Route::post('organisationsratting', [HomeController::class, 'organisationuserratting'])->name('organisation.rattingform');

Route::get('/organisations',[HomeController::class,'institutes'])->name('institutes');
Route::get('/organisations/details/{id}',[HomeController::class,'institute_detail'])->name('institutes.details');
Route::get('institutes/search',[HomeController::class,'institute_search'])->name('institutes.search');

Route::get('/jobs',[HomeController::class,'jobs'])->name('jobs');
Route::get('/jobs/details/{slug}',[HomeController::class,'job_detail'])->name('job.details');
Route::get('/blog/{slug}',[HomeController::class,'blogdetails'])->name('jobs.details');
Route::get('job/filter',[HomeController::class,'filter'])->name('jobs.filter');
Route::get('chnagepassword/',[HomeController::class,'chnagepassword']);
Route::post('chnagepassword_process/',[HomeController::class,'chnagepassword_process'])->name('telent.changepassword.process');

Route::get('/blog/details/{slug}',[HomeController::class,'blogdetails'])->name('blog.blogdetails');
Route::get('/talent/details/{username}',[HomeController::class,'vendordetails'])->name('user.vendordetails');
Route::post('/talent/contact',[HomeController::class,'vendorcontact'])->name('vendor.contact');
Route::get('register',[HomeController::class,'register'])->name('user.register');
Route::get('register-organisation',[HomeController::class,'register_organisation'])->name('user.register.organisation');
Route::get('/getcitybystate/{id}', [HomeController::class,'getcitybystate']);
Route::get('/getsubcat', [HomeController::class,'getsubcat']);
Route::get('/getisattrcategory', [HomeController::class,'getisattrcategory']);
Route::post('user_register',[UserController::class,'user_register'])->name('user.user_register');
Route::get('varify',[UserController::class,'varify_account']);
Route::get('login',[UserController::class,'index'])->name('user.login');
Route::post('user/auth',[UserController::class,'auth'])->name('user.auth');
Route::post('organisation_user/auth',[UserController::class,'organisation_user_auth'])->name('organisation_user.auth');
Route::post('organisation_user/register',[UserController::class,'organisation_register'])->name('organisation.register');
Route::get('/logout', function () {
    session()->forget('USER_ID');
    session()->forget('USER_NAME');
    session()->forget('organisation_ID');
    session()->forget('organisation_NAME');
    session()->flash('error','Logout sucessfully');
    return redirect('/');
})->name('user.logout');
Route::group(['middleware'=>'user_auth'],function(){

Route::get('user/genrate/reffercode',[ReferralController::class,'generateReferralCode'])->name('user.generateReferralCode');

Route::get('user/dashboard',[ProfileController::class,'index'])->name('user.dashboard');
Route::get('user/manage_profile',[ProfileController::class,'manage_profile'])->name('user.manage_profile');
Route::post('user/manage_profile_process',[ProfileController::class,'manage_profile_process'])->name('user.manage_profile_process');
Route::post('user/manage_profile_image',[ProfileController::class,'manage_profile_image'])->name('user.manage_profile_image');

Route::get('user/manage_videos',[ProfileController::class,'manage_videos'])->name('user.videos');
Route::post('user/manage_videos_process',[ProfileController::class,'manage_videos_process'])->name('user.manage_videos_process');

Route::post('user/manage_gallery_process',[ProfileController::class,'manage_gallery_process'])->name('user.manage_gallery_process');
Route::get('user/manage_gallery',[ProfileController::class,'manage_gallery'])->name('user.gallery');

Route::get('user/manage_socialmedia',[ProfileController::class,'manage_socialmedia'])->name('user.socialmedia');
// Route::get('user/manage_socialmedia/{user_id}',[ProfileController::class,'manage_socialmedia']);
Route::post('user/manage_socialmedia_process',[ProfileController::class,'manage_socialmedia_process'])->name('user.manage_socialmedia_process');

Route::get('user/delete/video/{id}',[ProfileController::class,'manage_video_delete']);
Route::get('user/gallery/delete/{id}',[ProfileController::class,'manage_gallery_delete']);
Route::get('user/confirm_password',[ProfileController::class,'change_password'])->name('user.change_password');
Route::post('user/change_password_process',[ProfileController::class,'change_password_process'])->name('user.change_password_process');

Route::get('job/apply/{user_id}/{job_posts_id}',[HomeController::class,'apply'])->name('jobs.apply');
Route::get('user/applied_job_list/',[ProfileController::class,'applied_job_list'])->name('user.applied_job_list');
Route::get('user/changeemail/',[ProfileController::class,'changeemail'])->name('user.changeemail');
});

Route::group(['middleware'=>'OrganisationUserAuth'],function(){

Route::get('organize/dashboard',[OrganisationController::class,'index'])->name('organize.dashboard');
Route::get('organize/manage_profile',[OrganisationController::class,'manage_profile'])->name('organize.manage_profile');
Route::post('organize/manage_profile_image',[OrganisationController::class,'manage_profile_image'])->name('organize.manage_profile_image');
Route::post('organize/manage_profile_process',[OrganisationController::class,'manage_profile_process'])->name('organize.manage_profile_process');
Route::get('organize/confirm_password',[OrganisationController::class,'change_password'])->name('organize.change_password');
Route::post('organize/change_password_process',[OrganisationController::class,'change_password_process'])->name('organize.change_password_process');
Route::get('organize/applied_user_list/{id}',[OrganisationController::class,'applied_user_list'])->name('organize.applied_user_list');
Route::get('organize/changeemail/',[OrganisationController::class,'changeemail'])->name('organize.changeemail');

Route::get('organize/job_posts',[OrganisationController::class,'job_posts'])->name('organize.job_posts');
Route::get('organize/manage_job_posts',[OrganisationController::class,'manage_job_posts'])->name('organize.manage_job_posts');
Route::get('organize/manage_job_posts/{id}',[OrganisationController::class,'manage_job_posts'])->name('organize.manage_job_posts_parm');
Route::post('organize/manage_job_process',[OrganisationController::class,'manage_job_process'])->name('organize.manage_job_process');
Route::get('organize/job_posts/delete/{id}',[OrganisationController::class,'job_posts_delete'])->name('organize.job_posts_delete');


Route::get('organize/event_posts',[EventController::class,'event_posts'])->name('organize.event_posts');
Route::get('organize/manage_event_posts',[EventController::class,'manage_event_posts'])->name('organize.manage_event_posts');
Route::get('organize/manage_event_posts/{id}',[EventController::class,'manage_event_posts'])->name('organize.manage_event_posts_parm');
Route::post('organize/manage_event_process',[EventController::class,'manage_event_process'])->name('organize.manage_event_process');
Route::get('organize/event_posts/delete/{id}',[EventController::class,'event_posts_delete'])->name('organize.event_posts_delete');

Route::get('organize/movie_posts',[MovieController::class,'movie_posts'])->name('organize.movie_posts');
Route::get('organize/manage_movie',[MovieController::class,'manage_movie'])->name('organize.manage_movie');
Route::get('organize/manage_movie/{id}',[MovieController::class,'manage_movie'])->name('organize.manage_movie_parm');
Route::post('organize/manage_movie_process',[MovieController::class,'manage_movie_process'])->name('organize.manage_movie_process');
Route::get('organize/movie_posts/delete/{id}',[MovieController::class,'movie_delete'])->name('organize.movie_delete');
Route::get('organize/search/profile',[MovieController::class,'search_user'])->name('movie.search_user');
Route::get('organize/movie/delete/cast/{id}',[MovieController::class,'delete_cast'])->name('movie.delete_cast');
Route::get('organize/movie/delete/crew/{id}',[MovieController::class,'delete_crew'])->name('movie.delete_crew');
Route::get('organize/movie/delete/video/{id}',[MovieController::class,'delete_video'])->name('movie.delete_video');
Route::get('organize/movie/delete/image/{id}',[MovieController::class,'delete_image'])->name('movie.delete_image');


Route::get('organize/institute_posts',[InstituteController::class,'institute_posts'])->name('organize.institute_posts');
Route::get('organize/manage_institute_posts',[InstituteController::class,'manage_institute_posts'])->name('organize.manage_institute_posts');
Route::get('organize/manage_institute_posts/{id}',[InstituteController::class,'manage_institute_posts'])->name('organize.manage_institute_posts_parm');
Route::post('organize/manage_institute_process',[InstituteController::class,'manage_institute_process'])->name('organize.manage_institute_process');
Route::get('organize/institute_posts/delete/{id}',[InstituteController::class,'institute_posts_delete'])->name('organize.institute_posts_delete');


Route::post('organize/manage_gallery_process',[GalleryController::class,'manage_gallery_process'])->name('organize.manage_gallery_process');
Route::get('organize/manage_gallery',[GalleryController::class,'manage_gallery'])->name('organize.manage_gallery');
Route::get('organize/gallery/delete/{id}',[GalleryController::class,'manage_gallery_delete']);


Route::get('organize/course_offered',[OrganisationController::class,'course_offered'])->name('organize.course_offered');
Route::post('organize/course_offered_process',[OrganisationController::class,'course_offered_process'])->name('organize.course_offered_process');
Route::get('organize/delete/offer/{id}',[OrganisationController::class,'course_offered_delete'])->name('organize.course_offer_delete');

Route::get('organize/job_offered',[OrganisationController::class,'job_offered'])->name('organize.job_offered');
Route::post('organize/job_offered_process',[OrganisationController::class,'job_offered_process'])->name('organize.job_offered_process');
Route::get('organize/delete/job/{id}',[OrganisationController::class,'job_offered_delete'])->name('organize.job_offered_delete');

Route::get('organize/manage_videos',[OrganisationController::class,'manage_videos'])->name('organize.videos');
Route::post('organize/manage_videos_process',[OrganisationController::class,'manage_videos_process'])->name('organize.manage_videos_process');
});

Route::get('send/birthday_wish/',[AdminController::class,'birthday_wish']);

Route::get('/createmail', function() {
    $exitCode = Artisan::call('make:controller RegistrationMailController');
    return 'DONEee'; //Return anything
});

// For the chatbot:



