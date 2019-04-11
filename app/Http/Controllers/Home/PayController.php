<?php

namespace App\Http\Controllers\Home;

use App\Events\OrderCreateEvent;
use App\Model\Members;
use App\Model\Order;
use App\Model\PayLog;
use App\Model\Schedule;
use App\Model\Service;
use App\Model\TicketLog;
use App\Model\Vip;
use ArrayObject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yansongda\LaravelPay\Facades\Pay;

class PayController extends Controller
{
    //判断客户端类型
    function clientType()
    {
        @$agent = strtolower($_SERVER ['HTTP_USER_AGENT']);
        //转换为小写
        $agent = strtolower($agent);
        $is_pc = (strpos($agent, 'windows nt')) ? true : false;
        //判断是否是在微信浏览器中打开
        $is_weixin = (strpos($agent, 'micromessenger')) ? true : false;
        if ($is_weixin) {
            return 'WX';
        }
        if ($is_pc) {
            return 'PC';
        }
        return 'MOBILE';
    }

    //办理会员
    public function handleMember(Request $request)
    {
        $id = $request->input('id');
        $title = $request->input('title');
        $charge = $request->input('charge');
        $discount = $request->input('discount');
        $handle_count = $request->input('handle_count');
        $reputation_value = $request->input('reputation_value');

        $config_biz = [
            'out_trade_no' => 'jyhy' . $id . $discount . $handle_count . $reputation_value . time(),
            'total_amount' => $charge,
            'subject' => '金鹰发艺' . $title . '会员办理',
            'timeout_express' => '5m',
        ];
        if ($this->clientType() == 'PC') {
            return Pay::alipay()->web($config_biz);
        } else {
            return Pay::alipay()->wap($config_biz);
        }
    }

    //在线支付订单
    public function payOrder(Request $request)
    {
        //将订单信息存入session，待支付成功回调时使用
        session()->put('orderArr', $request->all());
        $iDesignerId = $request->input('designer_id');
        $iTotalMoney = $request->input('terminal-money');
        $config_biz = [
            'out_trade_no' => 'jyddzf' . $iDesignerId . $iTotalMoney  . time(),
            'total_amount' => $iTotalMoney,
            'subject' => '金鹰发艺在线订单支付',
            'timeout_express' => '5m',
        ];
        if ($this->clientType() == 'PC') {
            return Pay::alipay()->web($config_biz);
        } else {
            return Pay::alipay()->wap($config_biz);
        }
    }

    public function checkData(Request $request)
    {
        $collection = Pay::alipay()->verify($request->all());
        if ($collection) {
            $out_trade_no = $collection['out_trade_no'];
            //当前登录顾客
            $iMemberId = Members::getIdByAccount(session()->get('member'))[0];
            //开启事务，修改数据
            DB::beginTransaction();
            try {
                $subject = '';
                if (starts_with($out_trade_no, 'jyhy')) {
                    //获取会员id
                    $iVipId = substr($out_trade_no, 4, 1);
                    $oVip = Vip::getVipById($iVipId);
                    $subject = '金鹰发艺' . $oVip->title . '会员办理';
                    //修改顾客身份信息
                    $member_identify = Members::updateMemberIdentify($iMemberId, $iVipId);
                    //增加会员办理人数
                    $handle_count = Vip::updateVipHandleCount($iVipId);
                }else if (starts_with($out_trade_no, 'jyddzf')){
                    $subject = '金鹰发艺在线订单支付';
                    $aInput = session()->pull('orderArr');
                    //获取入库日程id
                    $iScheduleId = Schedule::saveScheduleGetId($aInput);
                    //创建订单号
                    $sOrderNumber = Order::createOrderNumber(6);
                    //组织入库数据
                    $aData = [
                        'order_number' => $sOrderNumber,
                        'member_id' => $iMemberId,
                        'service_number' => json_encode(new arrayobject(explode(',', $aInput['service_number']))),
                        'designer_id' => $aInput['designer_id'],
                        'schedule_id' => $iScheduleId,
                        'total_money' => $aInput['terminal-money'],
                        'status' => 2,
                        'pay' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d', (time() - 120))
                    ];
                    $sCode = Order::saveTheOrder($aData);
                    if ($sCode != '1001') {
                        Log::info('订单入库失败');
                        abort(404);
                    }else {
                        //给造型师发送提醒
                        broadcast(new OrderCreateEvent(Order::getOrderByOrderNum($sOrderNumber)));
                        //更新票券使用状态
                        if (!is_null($aInput['ticket-id'])) {
                            TicketLog::useTickets(explode(',' ,$aInput['ticket-id']));
                        }
                        //在线支付增加信誉值与发币奖励
                        $iReputationValue = Service::calculateReputationValue(explode(',', $aInput['service_number']));
                        Members::changeReputationValue($iMemberId, $iReputationValue, 1);
                    }
                }
                //支付日志
                $pay_log = PayLog::addPayLog($iMemberId, $out_trade_no, $collection['total_amount'], $subject);

                if ($pay_log) {
                    DB::commit();
                    if (starts_with($out_trade_no, 'jyhy')){
                        return redirect('/member');
                    }else{
                        return redirect('/self');
                    }
                } else {
                    //todo 发起退款
                    Log::info('数据更新不同步');
                    abort(404);
                }
            } catch (\Exception $e) {
                //todo 发起退款
                DB::rollBack();
                Log::info('数据更新出错');
                abort(404);
            }
        } else {
            Log::info('空签');
            abort(404);
        }
    }
}
