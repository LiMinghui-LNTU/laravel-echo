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
use App\Model\MailActive;
use App\Model\Members;
use App\Model\Message;
use App\Model\Order;
use App\Model\OrderComment;
use App\Model\Schedule;
use App\Model\Service;
use App\Model\TicketLog;
use App\Model\Vip;
use ArrayObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

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
        //获取该顾客未使用的票券
        $oTickets = TicketLog::getUnUsedTicketById($oInfo->id);
        //查询全部订单
        $oOrders = Order::getOrdersByMemberId($oInfo->id);
        //获取未读消息条数
        $iNewMsg = Message::getUnreadMsgNum(1, 4);
        //获取关于登录顾客的消息
        $oMessages = Message::getMessages(Members::getIdByAccount(session()->get('member')[0])[0], Members::getIdByAccount(session()->get('member')[0])[0], 4, 4);
        return view($this->sViewPath . 'index', compact('sTitle', 'oInfo', 'oTickets', 'oOrders', 'oMessages', 'iNewMsg'));
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
            'service_number' => json_encode(new arrayobject(explode(',', $aInput['service_number']))),
            'designer_id' => $aInput['designer_id'],
            'schedule_id' => $iScheduleId,
            'total_money' => $aInput['total_money'],
            'status' => 2,
            'pay' => (int)$aInput['pay'] == 1 ? 0 : 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d', (time() - 120))
        ];
        $sCode = Order::saveTheOrder($aData);
        if ($sCode != '1001') {
            return json_encode(['success' => 0, 'code' => $sCode]);
        }else{
            //给造型师发送提醒
            broadcast(new OrderCreateEvent(Order::getOrderByOrderNum($sOrderNumber)));
            //更新票券使用状态
            if (isset($aInput['aId'])){
                TicketLog::useTickets($aInput['aId']);
            }
            //余额支付扣除账户余额
            if((int)$aInput['pay'] == 2){
                Members::changeBalanceByMemberId($oMember->id, (int)$aInput['total_money'], 0);
            }
            if ((int)$aInput['pay'] != 1){
                //在线支付增加信誉值
                $iReputationValue = Service::calculateReputationValue(explode(',', $aInput['service_number']));
                Members::changeReputationValue($oMember->id, $iReputationValue, 1);
            }
            return json_encode(['success' => 1]);
        }
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
        //该方法改做顾客阅读消息更新阅读状态
        Message::where('from', 2)->where('to', $id)->where('pre_type', 2)->where('type', 4)->update(['is_read' => 1]);
        return json_encode(['code' => 1001]);
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
        if ($reg_type == 1) {
            $account = Input::get('account-email');
            $password = Input::get('password-email');
        } else {
            $account = Input::get('phone_number');
            $password = Input::get('password_phone');
        }
        //邮箱注册顾客发送激活邮件
        if($reg_type == 1){
            $is_exist = MailActive::sendEmail($account);
            if($is_exist){
                //入库
                $res = Members::saveMember($account, $password, $reg_type);
            }else{
                $res = 0;
            }
        }elseif ($reg_type == 2){
            //入库
            $res = Members::saveMember($account, $password, $reg_type);
        }
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
        //判断当前顾客会员类型，给出会员折扣
        $oMember = Members::getMemberById(Members::getIdByAccount(session()->get('member')[0])[0]);
        if($oMember->vip_id != 1){
            $oVip = Vip::getVipById($oMember->vip_id);
            $fDiscount = $oVip->discount / 100;
            $fNewPrice = $oService->price * $fDiscount;
            return json_encode(['price' => $fNewPrice, 'time' => $oService->continue_to, 'reputation' => $oService->reputation_val]);
        }else{
            return json_encode(['price' => $oService->price, 'time' => $oService->continue_to, 'reputation' => $oService->reputation_val]);
        }
    }

    //前台获取某造型师日程
    public function postThisDesignerSchedule()
    {
        $iDesignerId = Input::get('designer_id');
        $aSchedule = Schedule::getScheduleById($iDesignerId);
        return json_encode($aSchedule);
    }

    //ajax顾客将消息发给店长
    public function sendMsg2Shopowner(Request $request)
    {
        $iId = $request->input('id');
        $iFrom = $request->input('from');
        $iPreType = $request->input('pre_type');
        $iTo = $request->input('to');
        $iType = $request->input('type');
        if (is_null($iFrom) || is_null($iPreType) || is_null($iTo) || is_null($iType)) {
            return json_encode(['code' => 1013, 'msg' => '非法参数']);
        } else {
            //查询此消息是否存在于列表中
            $oSeriesMessages = Message::getSeriesMessages($iFrom, $iTo, $iPreType, $iType);
            $oMessages = Message::getMessageById($iId);
            if (count($oSeriesMessages) > 1) {
                $oMyMessages = Message::getMessagesSentToMe($iTo, $iType);
                return json_encode(['code' => 1001, 'exist' => 1, 'msg_content' => (string)view('admin.message.message-content', compact('oMessages')), 'msg_list' => (string)view('admin.message.message-list', compact('oMyMessages'))]);
            } else {
                return json_encode(['code' => 1001, 'exist' => 0, 'msg_content' => (string)view('admin.message.message-content', compact('oMessages')), 'msg_tr' => (string)view('admin.message.message-tr', compact('oMessages'))]);
            }
        }
    }

    //ajax查询店长发出的消息进行回显
    public function getMsgFromShopowner(Request $request)
    {
        $iId = (int)$request->input('id');
        $oMessage = Message::getMessageById($iId);
        if (is_null($oMessage)) {
            return json_encode(['code' => 1010, 'msg' => '未找到消息数据']);
        } else {
            return json_encode(['code' => 1001, 'msg' => (string)view($this->sViewPath . 'message-content', compact('oMessage'))]);
        }
    }

    //订单支付页
    public function orderPay(Request $request)
    {
        $sTitle = '订单确认';
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $total_time = $request->input('total_time');
        $designer_id = $request->input('designer_id');
        $service_price = $request->input('service_price');
        $service_arr = $request->input('service_arr');
        //获取登录顾客账号
        $sAccount = session()->get('member');
        //查询顾客个人信息
        $oInfo = Members::getInfoByAccount($sAccount);
        //获取该顾客未使用的票券
        $oTickets = TicketLog::getUnUsedTicketById($oInfo->id);
        return view($this->sViewPath . 'order-pay', compact('sTitle', 'start_time', 'end_time', 'total_time', 'designer_id', 'service_price', 'service_arr', 'oTickets', 'oInfo'));
    }

    //获取正在是使用的卡券记录id
    public function getIdArr(Request $request)
    {
        $iType = (int)$request->input('type');
        $iQuota = (int)$request->input('quota');
        $iSkip = (int)$request->input('skip');
        $iTake = (int)$request->input('take');
        $aId = is_null($request->input('aId')) ? [] : (array)$request->input('aId');
        $iFlag = (int)$request->input('flag');
        $aLogId = array_column(TicketLog::getTicketLogId($iType, $iQuota, $iSkip, $iTake),'id');
        if ($iFlag == 1){
            $aLogId = array_merge($aId, $aLogId);
        }else{
            $aLogId = array_values(array_diff($aId, $aLogId));
        }
        $aLogId = array_map(function ($i){return (int)$i;},$aLogId);
        return json_encode(['arr'=>$aLogId]);
    }

    //取消订单操作
    public function doCancel(Request $request)
    {
        $iId = (int)$request->input('orderId');
        //查询该订单
        $oOrder = Order::getOrderById($iId);
        if(is_null($oOrder)){
            return json_encode(['code'=>1010, 'msg'=>'该订单不存在或已删除']);
        }else{
            //对已支付订单进行退款
            if($oOrder->pay == 1){
                Members::changeBalanceByMemberId(Members::getIdByAccount(session()->get('member')[0])[0], $oOrder->total_money, 1);
                Order::changeOrderInfo($iId, 'pay', 2);
            }
            //删除该订单对应日程
            Schedule::destroy($oOrder->schedule_id);
            //删除该订单
            Order::destroy($iId);
            return json_encode(['code'=>1001, 'msg'=>'订单已取消']);
        }
    }

    //给订单评分
    public function makeComments(Request $request)
    {
        //获取当前顾客
        $iMemberId = Members::getIdByAccount(session()->get('member')[0])[0];
        $iOrderId = (int)$request->input('order');
        $iScore = (int)$request->input('score');
        //评论入库
        $res = OrderComment::addComment($iMemberId, $iOrderId, $iScore);
        if($res){
            return json_encode(['code'=>1001, 'msg'=>'感谢您的评价']);
        }else{
            return json_encode(['code'=>1012, 'msg'=>'提交失败']);
        }
    }
}