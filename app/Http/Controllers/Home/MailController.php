<?php

namespace App\Http\Controllers\Home;

use App\Model\MailActive;
use App\Model\Members;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    //账户激活
    public function accountActivate(Request $request)
    {
        $key = $request->input('key');
        $oInfo = MailActive::getEmailByKey($key);
        //如果key错误跳转404
        if(is_null($oInfo)){
            abort(404);
        }else{
            $result = '即将激活';
            if((time()-strtotime($oInfo->created_at)) > 30 * 60 * 1000){
                $result = '链接已过期';
            }else{
                if(Members::accountActivate($oInfo->email)){
                    $result = '激活成功';
                }else{
                    $result = '激活失败';
                }
            }
            return view('home.email.result',compact('result'));
        }
    }
}
