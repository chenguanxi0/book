<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/25
 * Time: 14:47
 */

namespace App\Model;


class M3Email
{
    public $from; //发送人邮件
    public $to; //收件人邮件
    public $cc; //抄送
    public $attach; //附件
    public $subject; //主题
    public $content; //内容

}