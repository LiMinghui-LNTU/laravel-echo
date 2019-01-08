<?php
/**
 * Created by PhpStorm.
 * User: liminghui
 * Date: 2018/12/19
 * Time: 16:29
 */

namespace App\Http\Controllers;


use App\Events\PublicMessageEvent;
use Illuminate\Support\Facades\Input;

class ChatController extends Controller
{

    public function getIndex()
    {
        $sTitle = '聊天室';
        return view('echo',compact('sTitle'));
    }

    public function connect()
    {
        $name = Input::get('name');
        $message = Input::get('message');
        broadcast(new PublicMessageEvent($name."：".$message));
    }
}