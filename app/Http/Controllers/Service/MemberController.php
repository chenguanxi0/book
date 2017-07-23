<?php

namespace App\Http\Controllers\Service;

use App\Entity\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\TempPhone;
use App\Model\M3Result;
use App\Tool\Validate\ValidateCode;

class MemberController extends Controller
{
    public function register(Request $request){
        $email = $request->input('email','');
        $phone = $request->input('phone','');
        $password = $request->input('password','');
        $confirm = $request->input('confirm','');
        $phone_code = $request->input('phone_code','');
        $validate_code = $request->input('validate_code','');

        $M3Result = new M3Result;

        //手机号或邮箱不能为空
        if ($email == '' && $phone == ''){
            $M3Result->status = 1;
            $M3Result->message = '手机号或邮箱不能为空';
            return $M3Result->toJson();
        }
        //密码/确认密码不能小于6位数
        if (strlen($password) < 6 || $password == ''){
            $M3Result->status = 2;
            $M3Result->message = '密码不能小于6位数';
            return $M3Result->toJson();
        }
        if (strlen($confirm) < 6 || $confirm == ''){
            $M3Result->status = 3;
            $M3Result->message = '确认密码不能小于6位数';
            return $M3Result->toJson();
        }
        //两次密码不一致
        if ($password != $confirm){
            $M3Result->status = 4;
            $M3Result->message = '两次密码不一致';
            return $M3Result->toJson();
        }

        //手机注册
        if ($phone != ''){
            //手机验证码为6位
            if (strlen($phone_code) != 6 || $phone_code ==''){
                $M3Result->status = 5;
                $M3Result->message = '手机验证码为6位';
                return $M3Result->toJson();
            }

            $TempPhone = TempPhone::where('phone',$phone)->first();


            if ($TempPhone->code == $phone_code){
                if (strtotime($TempPhone->deadline) < time()){
                    $M3Result->status = 6;
                    $M3Result->message = '验证超时';
                    return $M3Result->toJson();
                }

//                验证码正确，存入数据库
                $member = new Member;
                $member->phone = $phone;
                $member->password = md5($password);
                $member->save();
                $M3Result->status = 0;
                $M3Result->message = '注册成功';
                return $M3Result->toJson();

            }else{
                $M3Result->status = 7;
                $M3Result->message = '验证码不正确';
                return $M3Result->toJson();
            }
            
        }else{
            //邮箱注册

            //验证码为4位
            if (strlen($validate_code) != 4 || $validate_code =''){
                $M3Result->status = 6;
                $M3Result->message = '验证码为4位';
                return $M3Result->toJson();
            }
            $Validate = new ValidateCode;
            if($Validate->getCode() != strtolower($validate_code)){
                $M3Result->status = 7;
                $M3Result->message = '验证码错误';
                return $M3Result->toJson();
            }

        }


        return $M3Result->toJson();
        
    }
}
