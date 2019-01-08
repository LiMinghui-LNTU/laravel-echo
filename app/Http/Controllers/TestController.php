<?php
/**
 * Created by PhpStorm.
 * User: liminghui
 * Date: 2018/12/17
 * Time: 15:15
 */

namespace App\Http\Controllers;


use App\Events\PrivateMessageEvent;
use App\Events\PublicMessageEvent;
use App\User;
use Illuminate\Support\Facades\Input;

class TestController extends Controller
{
    public function getIndex()
    {
        $sTitle = '广播测试';
        $oUser = User::getAllUser();
        return view('test.index', compact('sTitle', 'oUser'));
    }

    public function getPush()
    {
        $message = Input::get('message');
        broadcast(new PublicMessageEvent($message));
        return redirect()->back()->withInput(['message'=>$message]);
    }

    public function privatePush()
    {
        $id = Input::get('user');
        $message = Input::get('private-message');
        $oUser = User::findUser($id);
        if(empty($oUser)){
            return '无此用户';
        }
//        if(Auth::user()->id != $id){
//            return '不是本人';
//        }
        broadcast(new PrivateMessageEvent($oUser, $message));
        return redirect()->back()->withInput(['message'=>$message]);
    }
}