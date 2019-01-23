<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2018/12/30
 * Time: 22:18
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Model\Designer;
use App\Model\Members;
use App\Model\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SelfController extends Controller
{
    private $sViewPath = 'home.self.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sTitle = '个人中心';
        return view($this->sViewPath . 'index', compact('sTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sTitle = '订单创建';
        //拿到短发服务
        $oShortServices = Service::getServices(1);
        //拿到长发服务
        $oLongServices = Service::getServices(2);
        //拿到造型师
        $oDesigners = Designer::getAllDesigners();
        return view($this->sViewPath . 'order-create', compact('sTitle', 'oShortServices', 'oLongServices','oDesigners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //登录/注册页
    public function getLogin()
    {
        $sTitle = '顾客登录/注册';
        return view($this->sViewPath . 'login', compact('sTitle'));
    }

    //注册逻辑
    public function postReg()
    {
        //获取注册类型 1-邮箱注册 2-手机号注册
        $reg_type = Input::get('reg-type');
        $account = ''; //账号
        $password = ''; //密码
        if ($reg_type == 1) {
            $account = Input::get('account-email');
            $password = Input::get('password-email');
        } else {
            $account = Input::get('phone_number');
            $password = Input::get('password_phone');
        }
        //入库
        $res = Members::saveMember($account, $password, $reg_type);
        return json_encode(['success' => $res]);
    }

    //登录逻辑
    public function postLogin()
    {
        $account = Input::get('account');
        $password = Input::get('password');
        $code = Members::checkAccount($account, $password);
        $data = ['success' => false, 'code' => $code];
        if ($code == 1001) {
            $data['success'] = true;
            session()->push('member', $account);
        }
        return json_encode($data);
    }

    //登出
    public function getLogout()
    {
        session()->flash('member');
        return redirect('/login');
    }

    //检查是已注册
    public function checkReg()
    {
        $account = Input::get('account');
        return Members::isRegister($account);
    }
}