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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'Api\AuthController@login');
    Route::post('register', 'Api\AuthController@register');
    //jwt verify after apis
 
    
    Route::post('/forgot-password', 'Api\ForgotPasswordController@sendResetLinkEmail');
    
    Route::group(['middleware' => 'jwt.verify'], function ($api_child) {
        $api_child->post('change-password','Api\AuthController@changepassword');
        $api_child->post('otpVerify','Api\AuthController@otpVerify');
        $api_child->get('get-user-details','Api\AuthController@getUser');
        $api_child->post('update-user-details', 'Api\AuthController@update_user');
        $api_child->post('resend-otp', 'Api\AuthController@resendOtp');
    });

});