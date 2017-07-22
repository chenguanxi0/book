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

Route::get('/login','View\MemberController@toLogin');
Route::get('/zend','View\MemberController@zend');
Route::get('/register','View\MemberController@toRegister');

Route::any('/service/validate_code/create','Service\ValidateController@create');