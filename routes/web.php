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

//分类页
Route::get('/category','View\BookController@toCategory');

//列表页
Route::get('/product/category_id/{category_id}','View\BookController@toProduct');

//详情页
Route::get('/product/{product_id}','View\BookController@toPdtContent');

Route::get('/cart','View\CartController@toCart');


Route::group(['prefix' => '/service'], function () {
    //图形验证码
    Route::get('validate_code/create','Service\ValidateController@create');

//手机验证码
    Route::post('validate_phone/zend','Service\ValidateController@zendSMS');

//验证注册信息
    Route::post('register','Service\MemberController@register');

//验证登陆
    Route::post('login','Service\MemberController@login');

//验证邮箱
    Route::post('validate_email','Service\ValidateController@validate_email');

//分类页
    Route::get('category/parent_id/{parent_id}','Service\BookController@toCategory');

//添加购物车
    Route::get('cart/add/{product_id}','Service\addCartController@addCart');
    
    Route::get('cart/delete','Service\addCartController@deleteCart');

});

//验证登陆中间件
Route::group(['middleware'=>'check.login'],function(){

});