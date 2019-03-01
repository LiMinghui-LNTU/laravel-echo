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

Broadcast::channel('privatePush.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

//订单频道授权：验证任意试图监听order.id频道的造型师确实是被选择的造型师
Broadcast::channel('order.{designerId}', function ($user, $designerId) {
    \Illuminate\Support\Facades\Log::info("左：" . $user->id);
    \Illuminate\Support\Facades\Log::info("右：" . \App\Model\Designer::getUserIdById($designerId)[0]);
    return (int)$user->id === (int) \App\Model\Designer::getUserIdById($designerId)[0];
});