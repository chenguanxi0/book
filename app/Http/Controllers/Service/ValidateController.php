<?php

namespace App\Http\Controllers\Service;

use App\Tool\Validate\ValidateCode;
use App\Tool\SMS\SMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\TempPhone;
use App\Model\M3Result;
use App\Entity\TempEmail;
use App\Entity\Member;
//验证码控制器
class ValidateController extends Controller
{
//    生成图形验证码
    public function create(Request $request)
    {
        $ValidateCode = new ValidateCode;
        $request->session()->put('validate',$ValidateCode->getCode());

        return $ValidateCode->doimg();
    }

//    发送手机端验证码
    public function zendSMS(Request $request)
    {
//        返回结果接口
        $m3result = new M3Result;

//        判断手机号
        $phone = $request->input('phone','');
        if ( $phone == ''){
            $m3result->status = 1;
            $m3result->message = '手机号不能为空';
            return $m3result->toJson();
        }

        $member = Member::where('phone',$phone)->first();
        if ($member != null){
            $m3result->status = 2;
            $m3result->message = '该手机号已经注册，请直接登陆';
            return $m3result->toJson();
        }

        $code = '';
        $charset = '1234567890';
        $_len = strlen($charset) - 1;
        for ($i = 0;$i < 6;++$i) {
            $code .= $charset[mt_rand(0, $_len)];
        }

        $sms = new SMS($phone,$code,5);

        $m3result = $sms->zend();


        if ( $m3result->status == 0){

            //保存数据到临时表
            $tempPhone = TempPhone::where('phone',$phone)->first();
            if ($tempPhone == null){
                $tempPhone = new TempPhone;
            }

            $tempPhone->phone = $phone;
            $tempPhone->code = $code;
            $tempPhone->deadline = date('Y-m-d H:i:s',time()+5*60);
            $tempPhone->save();


        }


        return $m3result->toJson();

    }


    public function validate_email(Request $request)
    {
        $member_id = $request->input('member_id','');
        $code = $request->input('code','');
        if ($member_id == null || $code == null){
            return '验证异常';
        }

        $TempEmail = TempEmail::where('member_id',$member_id)->first();
        if ($TempEmail == null){
            return '验证异常';
        }
        if ($TempEmail->code == $code){
            if (strtotime($TempEmail->deadline) < time()){
                return '验证超时';
            }

            $member = Member::where('id',$member_id)->first();
            $member->active = 1;
            $member->save();
            return redirect('/login');

        }else{
            return '验证链接失效';
        }

    }
}
