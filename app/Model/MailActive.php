<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class MailActive extends Model
{
    use SoftDeletes;

    protected $table = 'mail_activate';

    protected $guarded = ['id', 'deleted_at'];

    /**
     * 向注册邮箱发送邮件
     */
    public static function sendEmail($sEmail = '')
    {
        //生成32位随机验证字符串
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $sNumber = '';
        for ($i = 32; $i > 0; $i--) {
            $sNumber .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        $sKey = md5($sNumber);
        //发送邮件
        $to = $sEmail;
        $subject = '【金鹰发艺】顾客账户激活邮件';
        try{
            Mail::send(
                'home.email.activate',
                ['content' => $sKey],
                function ($message) use($to, $subject) {
                    $message->to($to)->subject($subject);
                }
            );
            // 邮箱有效激活信息入库
            self::insert(['email'=>$sEmail, 'key'=>$sKey, 'created_at'=>date('Y-m-d H:i:s')]);
            return 1;
        }catch (\Exception $e){
            return 0;
        }
    }

    /**
     * 根据key获取已发送的邮件信息
     */
    public static function getEmailByKey($sKey = '')
    {
        return self::where('key', $sKey)->first();
    }
}
