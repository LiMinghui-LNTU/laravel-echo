<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2018/12/30
 * Time: 22:18
 */

namespace App\Http\Controllers\Home;


use App\Events\MessageEvent;
use App\Events\OrderCreateEvent;
use App\Http\Controllers\Controller;
use App\Model\Designer;
use App\Model\Members;
use App\Model\Message;
use App\Model\Order;
use App\Model\Schedule;
use App\Model\Service;
use ArrayObject;
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
        //获取登录顾客账号
        $sAccount = session()->get('member');
        //查询顾客个人信息
        $oInfo = Members::getInfoByAccount($sAccount);
        //查询全部订单
        $oOrders = Order::getOrdersByMemberId($oInfo->id);
        //获取关于登录顾客的消息
        $oMessages = Message::getMessages(Members::getIdByAccount(session()->get('member')[0])[0], Members::getIdByAccount(session()->get('member')[0])[0], 4, 4);
        return view($this->sViewPath . 'index', compact('sTitle', 'oInfo', 'oOrders', 'oMessages'));
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
        //拿到预订者账号
        $sAccount = session()->get('member');
        return view($this->sViewPath . 'order-create', compact('sTitle', 'oShortServices', 'oLongServices', 'oDesigners', 'sAccount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aInput = $request->all();
        //获取入库日程id
        $iScheduleId = Schedule::saveScheduleGetId($aInput);
        //创建订单号
        $sOrderNumber = Order::createOrderNumber(6);
        //获取预订人
        $oMember = Members::getInfoByAccount(session()->get('member'));
        //组织入库数据
        $aData = [
            'order_number' => $sOrderNumber,
            'member_id' => $oMember->id,
            'service_number' => json_encode(new arrayobject($aInput['service_number'])),
            'designer_id' => $aInput['designer_id'],
            'schedule_id' => $iScheduleId,
            'total_money' => $aInput['total_money'],
            'status' => 2,
            'pay' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d', (time() - 120))
        ];
        $sCode = Order::saveTheOrder($aData);
        //给造型师发送提醒
        broadcast(new OrderCreateEvent(Order::getOrderByOrderNum($sOrderNumber)));
        if ($sCode != '1001') {
            return json_encode(['success' => 0, 'code' => $sCode]);
        }
        return json_encode(['success' => 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //该方法改做向店长发送消息
        $iId = (int)$request->input('message_from');
        $oMember = Members::getMemberById($id);
        if (is_null($oMember) || $iId != $id) {
            return json_encode(['code' => 1010, 'msg' => '该用户不存在']);
        } else {
            //保存消息
            $aMessage = array(
                'from' => $iId,
                'to' => (int)$request->input('message_to'),
                'content' => trim($request->input('message_content')),
                'pre_type' => 4,
                'type' => (int)$request->input('type'),
                'created_at' => date('Y-m-d H:i:s')
            );
            $iMessageId = Message::saveMessage($aMessage);
            //获取消息对象
            $oMessage = Message::getMessageById($iMessageId);
            //发送消息给店长
            broadcast(new MessageEvent($oMessage));
            return json_encode(['code' => 1001, 'msg' => (string)view($this->sViewPath . 'message-content', compact('oMessage'))]);
        }
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

    //前台获取服务id对应的服务时长及价位
    public function postTimeAndPrice()
    {
        $sServiceNum = Input::get('service_num');
        $oService = Service::getServiceByNum($sServiceNum);
        return json_encode(['price' => $oService->price, 'time' => $oService->continue_to, 'reputation' => $oService->reputation_val]);
    }

    //前台获取某造型师日程
    public function postThisDesignerSchedule()
    {
        $iDesignerId = Input::get('designer_id');
        $aSchedule = Schedule::getScheduleById($iDesignerId);
        return json_encode($aSchedule);
    }
}