<?php

use App\Models\Memorial;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

Route::get('/auth-login', function () {
    return view('auth-login');
})->name('auth-login');
Route::get('/auth-register', function () {
    $smart_captcha = rand(1001, 9999);
    return view('auth-register', ['smart_captcha' => $smart_captcha]);
})->name('auth-register');
Route::post('/auth-register', 'Auth\RegisterController@create');
Route::post('/auth-register/send-otp', 'Auth\RegisterController@sendOTP');

Route::post('/auth-register/send-number', 'Auth\RegisterController@sendNumber');

Route::post('/auth-register/verify-number', 'Auth\RegisterController@verifyNumber');
Route::post('/auth-register/resend-number', 'Auth\RegisterController@resendNumber');


Route::post('/auth-login', 'Auth\LoginController@login');

//reset password with email
Route::get('/auth-login/reset', function () {
    return view('auth-recoverpw');
});
Route::post('/reset-password/email', 'Auth\ResetPasswordController@sendNumber');
Route::get('/reset-password/email/verify/{id}','Auth\ResetPasswordController@emailVerify' );
Route::post('/reset-password/email/confirm', 'Auth\ResetPasswordController@verifyNumber');




Auth::routes();

Route::get('pages-login', 'SkoteController@index');
Route::get('pages-login-2', 'SkoteController@index');
Route::get('pages-register', 'SkoteController@index');
Route::get('pages-register-2', 'SkoteController@index');
Route::get('pages-recoverpw', 'SkoteController@index');
Route::get('pages-recoverpw-2', 'SkoteController@index');
Route::get('pages-lock-screen', 'SkoteController@index');
Route::get('pages-lock-screen-2', 'SkoteController@index');
Route::get('pages-404', 'SkoteController@index');
Route::get('pages-500', 'SkoteController@index');
Route::get('pages-maintenance', 'SkoteController@index');
Route::get('pages-comingsoon', 'SkoteController@index');

Route::post('keep-live', 'SkoteController@live');

// Route::get('index/{locale}', 'LocaleController@lang');

//social -login
Route::get('/{provider}/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

//facebook
// Route::get('/facebook/redirect', 'Auth\LoginController@redirectToFBProvider');
// Route::get('/facebook/callback', 'Auth\LoginController@handleFBProviderCallback');


Route::get('/login', function () {
    return redirect()->route('auth-login');
})->name('login');



Route::get('/index', function(){
    redirect()->route('index');
});

Route::get('/', function(){
    return view('home');
})->name('index');
