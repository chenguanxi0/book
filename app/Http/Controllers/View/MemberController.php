<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MemberController extends Controller
{
    public function toLogin(Request $request)
    {
        $return = $request->input('return');
        return view('login')->with('return',urldecode($return));
    }

    public function toRegister()
    {
        return view('register');
    }


}
