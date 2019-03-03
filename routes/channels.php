<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

//订单频道授权：验证任意试图监听order.id频道的造型师确实是被选择的造型师
Broadcast::channel('order.{designerId}', function ($user, $designerId) {
    \Illuminate\Support\Facades\Log::info("------------------");
    \Illuminate\Support\Facades\Log::info("左：" . $user->id);
    \Illuminate\Support\Facades\Log::info("右：" . \App\Model\Designer::getUserIdById($designerId)[0]);
    return (int)$user->id === (int)\App\Model\Designer::getUserIdById($designerId)[0];
});

//消息接收频道授权：验证任意试图监听message.to频道的人员确实是消息的接收者
Broadcast::channel('message.{to}', function ($user, $to) {
    \Illuminate\Support\Facades\Log::info('发送给：' . $to);
    \Illuminate\Support\Facades\Log::info('登录顾客：' . session()->get('member')[0]);
    //截取最后一位，获取用户类型
    $iType = substr($to, -1);
    $number = substr($to,0,strlen($to)-1);
    \Illuminate\Support\Facades\Log::info('用户类型：' . $iType);
    if($iType == 4){ //顾客身份
        return (int)(\App\Model\Members::getIdByAccount(session()->get('member')[0])[0]) === (int)$number;
    }else{
        return (int)$user->id === (int)$number;
    }
});