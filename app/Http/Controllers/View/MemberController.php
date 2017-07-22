<?php

namespace App\Http\Controllers\View;


use App\Http\Controllers\Controller;
use App\Tool\SMS\SMS;

class MemberController extends Controller
{
    public function toLogin()
    {

        return view('login');
    }

    public function toRegister()
    {
        return view('register');
    }
    public function zend()
    {
         $sms = new SMS(13125082176,456789,5);
         $sms->zend();
    }
}
