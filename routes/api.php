<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:api')->group(function()  {

    // Route::get('{any}', 'BackendController@index')->where('any', '.*')->name('home');
    Route::get('/getAuthUser', 'UserController@getAuthUser');
    Route::post('/auth-user/nameUpdate', 'UserController@updateAuthInformation');
    Route::post('/auth-user/passwordUpdate', 'UserController@updatePassword');
    Route::post('/profile/add-image', 'UserController@updateImage');
    Route::post('/profile/remove-image', 'UserController@removeImage');


    // banner route part starts
    Route::post('/get-banner', 'BannerController@index');
    Route::post('/store-change/banner-info', 'BannerController@storeBannerPart');
    Route::post('/add-banner-image', 'BannerController@storeBannerImage');
    Route::post('/banner/remove-image', 'BannerController@removeBannerImage');
    // banner route part ends
    // Logo route part starts
    Route::post('/user/get-logo', 'UserController@getUserLogo');
    Route::post('/add-logo-image', 'UserController@updateLogoImage');
    Route::post('/logo/remove-image', 'UserController@removeLogoImage');
    // Logo route part ends

    // about route part starts
    Route::post('/get-about', 'AboutController@index');
    Route::post('/change-about-info', 'AboutController@updateAboutInfo');
    Route::post('/add-about-image', 'AboutController@updateAboutImage');
    Route::post('/about/remove-image', 'AboutController@removeImage');

    // about route part ends
    // service route part starts
    Route::post('/add-service-image', 'ServiceController@addServiceImage');
    Route::post('/store-services', 'ServiceController@storeService');
    Route::post('/delete-service-image', 'ServiceController@deleteServiceImage');
    Route::post('/get-services', 'ServiceController@getServices');
    Route::post('/service-search', 'ServiceController@searchService');
    Route::post('/service-edit', 'ServiceController@updateService');
    Route::post('/edit-service-image', 'ServiceController@editServiceImage');
    Route::post('/service-delete', 'ServiceController@deleteService');
    // service route part ends

    // image category starts
    Route::post('/add-image-category', 'ImageController@addImageCategory');
    Route::post('/get-image-category', 'ImageController@getImageCategory');
    Route::post('/edit-image-category', 'ImageController@editImageCategory');
    Route::post('/delete-image-category', 'ImageController@deleteImageCategory');
    Route::post('/image-category-search', 'ImageController@searchImageCategory');
    // image category ends

    // image part starts
    Route::post('/add-image-image', 'ImageController@storeImage');
    Route::post('/delete-portfolio-image', 'ImageController@deleteImage');
    Route::post('/add-portfolio-image-db', 'ImageController@addImageToDB');
    Route::post('/get-portfolio-image', 'ImageController@index');
    Route::post('/edit-portfolio-image', 'ImageController@eiditPortfolioImage');
    Route::post('/delete-portfolio-image-db', 'ImageController@deletePortfolioImageDB');
    Route::post('/portfolio-image-search', 'ImageController@searchPortfolioImages');
    // image part ends

    // route video category starts
    Route::post('/add-video-playlist', 'VideoController@addVideoPlaylist');
    Route::post('/get-video-playlist', 'VideoController@getVideoPlaylist');
    Route::post('/edit-video-playlist', 'VideoController@editVideoPlaylist');
    Route::post('/delete-video-playlist', 'VideoController@deleteVideoPlaylist');
    Route::post('/search-video-playlist', 'VideoController@searchVideoPlaylist');
    // route video category ends
    // route video starts
    Route::post('/add-video-image', 'VideoController@addVideoImage');
    Route::post('/delete-video-image', 'VideoController@deleteVideoImage');
    Route::post('/store-video', 'VideoController@addVideo');
    Route::post('/get-video', 'VideoController@index');
    Route::post('/edit-video-db', 'VideoController@editVideoDB');
    Route::post('/delete-video-db', 'VideoController@deleteVideoDB');
    Route::post('/search-video-db', 'VideoController@searchVideoDB');
    // route video ends

    // testimonial part starts
    Route::post('/add-testimonial-image', 'TestimonialController@storeTestiImage');
    Route::post('/testi-image-delete', 'TestimonialController@deleteTestiImage');
    Route::post('/add-testi-db', 'TestimonialController@storeTestimonialDB');
    Route::post('/get-testi-monial', 'TestimonialController@index');
    Route::post('/edit-testi-db', 'TestimonialController@editTestiDB');
    Route::post('/delete-testi-db', 'TestimonialController@deleteTestiDB');
    Route::post('/search-testi-db', 'TestimonialController@searchTestiDB');
    // testimonial part ends

    // footer part starts
    Route::post('/get-footer-text', 'FooterController@getFooter');
    Route::post('/update-footer-text', 'FooterController@updateFootertext');
    Route::post('/add-footer-social-image', 'FooterController@addFooterSocialImage');
    Route::post('/delete-social-image', 'FooterController@deleteFooterSocialImage');
    Route::post('/social-image-db', 'FooterController@addSocialImageDB');
    Route::post('/get-social-db', 'FooterController@getSocialFooter');
    Route::post('/delete-footer-social', 'FooterController@deleteSocialFooterDB');
    Route::post('/search-footer-social', 'FooterController@searchSocialFooter');
    // footer part ends
    // skill part starts
    Route::post('/get-skills', 'SkillController@index');
    Route::post('/update-skills', 'SkillController@updateSkills');
    // skill part ends

    // typed part starts
    Route::post('/store-typed', 'BannerController@storeTyped');
    Route::post('/edit-typed', 'BannerController@editTyped');
    Route::post('/get-typed', 'BannerController@getTyped');
    Route::post('/delete-typed', 'BannerController@deleteTyped');
    // typed part ends

    // contact part starts
    Route::post('/get-contact', 'ContactController@getContacts');
    Route::post('/delete-contact', 'ContactController@deleteContact');
    // contact part ends


});

