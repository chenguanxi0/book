<?php

namespace App\Tool\SMS;

//手机短信验证
class SMS
{
     private $funAndOperate = "industrySMS/sendSMS";
     private $smsContent = "【大头科技】您的验证码为{1}，请于{2}分钟内正确输入，如非本人操作，请忽略此短信。";
     private $to ='13125082176';
     private $ACCOUNT_SID ='1fcb5ccab1b0474193f5c26c1f3177b9';
     private $AUTH_TOKEN ='ab9e671c156045e08c0b3f39df904893';
     private $BASE_URL ='https://api.miaodiyun.com/20150822/';
     private $CONTENT_TYPE = "application/x-www-form-urlencoded";
     private  $ACCEPT = "application/json";

    public function __construct($phone,$random,$time){

        $this->smsContent = '【大头科技】您的验证码为'.$random.'，请于'.$time.'分钟内正确输入，如非本人操作，请忽略此短信。';
        $this->to =$phone;
    }


    function createUrl($funAndOperate)
    {

        // 时间戳
        date_default_timezone_set("Asia/Shanghai");


        return $this->BASE_URL . $funAndOperate;
    }


    function createBasicAuthData()
    {
        date_default_timezone_set("Asia/Shanghai");
        $timestamp = date("YmdHis");
        // 签名
        $sig = md5($this->ACCOUNT_SID . $this->AUTH_TOKEN . $timestamp);
        return array("accountSid" => $this->ACCOUNT_SID, "timestamp" => $timestamp, "sig" => $sig, "respDataType" => "JSON");
    }


    function createHeaders()
    {


        $headers = array('Content-type: ' . $this->CONTENT_TYPE, 'Accept: ' . $this->ACCEPT);

        return $headers;
    }


    function post($funAndOperate, $body)
    {


        // 构造请求数据
        $url = $this->createUrl($funAndOperate);
        $headers = $this->createHeaders();

        echo("url:<br/>" . $url . "\n");
        echo("<br/><br/>body:<br/>" . json_encode($body));
        echo("<br/><br/>headers:<br/>");
        var_dump($headers);

        // 要求post请求的消息体为&拼接的字符串，所以做下面转换
        $fields_string = "";
        foreach ($body as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');

        // 提交请求
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $url);
        curl_setopt($con, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($con, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($con, CURLOPT_HEADER, 0);
        curl_setopt($con, CURLOPT_POST, 1);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($con, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($con, CURLOPT_POSTFIELDS, $fields_string);
        $result = curl_exec($con);
        curl_close($con);

        return "" . $result;
    }


    function zend(){
       $body=$this->createBasicAuthData();
        $body['smsContent'] = $this->smsContent;
        $body['to'] = $this->to;

        $result = $this->post($this->funAndOperate, $body);
        echo("<br/>result:<br/><br/>");
        var_dump($result);
    }


}