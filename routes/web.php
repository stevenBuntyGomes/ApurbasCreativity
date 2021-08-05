<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'FrontendController@index');
Route::get('/portfolio-video', 'FrontendController@portfolioVideos');
Route::get('/testimonial', 'FrontendController@testimonial');
Route::get('/portfolio-image', 'FrontendController@portfolioImages');
Route::post('/store-contact-information', 'ContactController@storeContact')->name('contact.store');

Auth::routes(['register' => false]);

Route::get('/auth{any}', 'BackendController@index')->where('any', '.*')->middleware('auth');

