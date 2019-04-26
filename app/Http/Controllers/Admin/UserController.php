<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2019/1/1
 * Time: 10:40
 */

namespace App\Http\Controllers\Admin;


use App\Events\MessageEvent;
use App\Events\PublicMessageEvent;
use App\Http\Controllers\Controller;
use App\Model\Message;
use App\Model\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $sViewPath = 'admin.';

    //登录
    public function getLogin()
    {
        $oRole = Role::getAllRoles();
        return view($this->sViewPath . 'login.login', compact('oRole'));
    }

    //登录逻辑
    public function postLogin()
    {
        $oInput = Input::all();
        $data = array(
            'username' => trim($oInput['username']),
            'password' => trim($oInput['password']),
            'role' => isset($oInput['role']) ? trim($oInput['role']) : '',
        );
        $validator = User::identifyValid($data);
        if ($validator->fails()) {
            Session::flash('warning', $validator->messages()->first());
            return redirect()->back()->withInput();
        }
        if (Auth::attempt(array('username' => $data['username'], 'password' => $data['password'], 'role_id' => $data['role']))) {
            session()->put('role_id', $data['role']);
            return redirect('/admin');
        } else {
            Session::flash('error', '账号或密码错误');
            return redirect()->back()->withInput();
        }

    }

    //登出
    public function getLogout()
    {
        Auth::logout();
        return redirect('/admin');
    }

    //后台首页
    public function index()
    {
        $role_id = session()->get('role_id');
        switch ($role_id) {
            case 1: //管理员
                $sTitle = '管理员首页';
                $sidebar = 'admin.layout.sidebar';
                $content = 'admin.admin.content';
                //获取全部管理员和店长
                $oPeople = User::getAllAdministrators();
                return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oPeople'));
                break;
            case 2: //店长
                return redirect('/admin/shopowner');
                break;
            case 3: //店员
                return redirect('/admin/clerk');
                break;
            default:
                abort('503');
        }
    }

    public function create()
    {
        $sTitle = '添加管理者';
        $sidebar = 'admin.layout.sidebar';
        $content = 'admin.admin.create';
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content'));
    }

    public function store(Request $request)
    {
        $aData = array(
            'username'=>trim($request->input('username')),
            'password'=>trim($request->input('password')),
            'role_id'=>$request->input('role_id'),
            'email'=>trim($request->input('email')),
            'phone'=>trim($request->input('phone'))
        );
        $validator = User::addValidate($aData);
        if($validator->fails()){
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        }else{
            //信息入库
            $res = User::saveAdministrator($aData);
            if($res){
                return redirect('/admin');
            }else{
                Session::flash('error', '数据入库失败');
                return redirect()->back()->withInput();
            }
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $sTitle = '编辑信息';
        $sidebar = 'admin.layout.sidebar';
        $content = 'admin.admin.edit';
        $oUser = User::getUserById($id);
        if (is_null($id) || is_null($oUser)) {
            Session::flash('error', '该用户不存在或已删除');
            return redirect()->back()->withInput();
        } else {
            return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oUser'));
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    //我的消息
    public function myMessage()
    {
        $sTitle = '消息内容';
        $sidebar = 'admin.layout.sidebar';
        $content = 'admin.admin.message';
        //查询当前登录者
        $oUser = User::getUserById(Auth::User()->id);
        //查询消息
        $oMyMessages = Message::getMessages($oUser->id, $oUser->id, $oUser->role_id, $oUser->role_id);
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oUser', 'oMyMessages'));
    }

    //店长回复消息
    public function adminReply(Request $request)
    {
        //获取消息接收方
        $iTo = (int)$request->input('to');
        $iType = (int)$request->input('type');
        $sContent = trim($request->input('content'));
        if (is_null($iTo) || is_null($iType) || is_null($sContent)) {
            return json_encode(['code' => 1013, 'msg' => '非法参数']);
        } else {
            //构建消息并保存
            $aMessage = array(
                'from' => 1,
                'to' => $iTo,
                'content' => $sContent,
                'pre_type' => 1,
                'type' => $iType,
                'created_at' => date('Y-m-d H:i:s')
            );
            $iId = Message::saveMessage($aMessage);
            $oMessages = Message::getMessageById($iId);
            //广播消息：回复顾客在公共频道，其他人在私有频道
            if($oMessages->type == 4){
                broadcast(new PublicMessageEvent($oMessages));
            }else{
                broadcast(new MessageEvent($oMessages));
            }
            return json_encode(['code' => 1001, 'msg' => (string)view($this->sViewPath . 'message.message-content', compact('oMessages'))]);
        }
    }
}