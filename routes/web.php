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
    return view('welcome');
});

//登陆
Route::get('/login','View\MemberController@toLogin');

//注册
Route::get('/register','View\MemberController@toRegister');

//图形验证码
Route::any('/service/validate_code/create','Service\ValidateController@create');

//手机验证码
Route::any('/service/validate_phone/zend','Service\ValidateController@zendSMS');