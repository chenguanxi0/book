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

Route::get('/category','View\BookController@toCategory');

Route::get('/product/category_id/{category_id}','View\BookController@toProduct');



Route::group(['prefix' => 'service'], function () {
    //图形验证码
    Route::get('validate_code/create','Service\ValidateController@create');

//手机验证码
    Route::post('validate_phone/zend','Service\ValidateController@zendSMS');

//验证注册信息
    Route::post('register','Service\MemberController@register');

    Route::post('login','Service\MemberController@login');

    Route::post('validate_email','Service\ValidateController@validate_email');

    Route::get('category/parent_id/{parent_id}','Service\BookController@toCategory');
});
