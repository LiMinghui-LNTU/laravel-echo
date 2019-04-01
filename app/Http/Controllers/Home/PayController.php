<?php

namespace App\Http\Controllers\Home;

use App\Model\Members;
use App\Model\PayLog;
use App\Model\Vip;
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

    public function checkData(Request $request)
    {
        $collection = Pay::alipay()->verify($request->all());
        if ($collection) {
            $out_trade_no = $collection['out_trade_no'];
            //获取会员id
            $iVipId = substr($out_trade_no, 4, 1);
            //当前登录顾客
            $iMemberId = Members::getIdByAccount(session()->get('member'))[0];
            //开启事务，修改数据
            DB::beginTransaction();
            try {
                $subject = '';
                if (starts_with($out_trade_no, 'jyhy')) {
                    $oVip = Vip::getVipById($iVipId);
                    $subject = '金鹰发艺' . $oVip->title . '会员办理';
                }
                //支付日志
                $pay_log = PayLog::addPayLog($iMemberId, $out_trade_no, $collection['total_amount'], $subject);
                //修改顾客身份信息
                $member_identify = Members::updateMemberIdentify($iMemberId, $iVipId);
                //增加会员办理人数
                $handle_count = Vip::updateVipHandleCount($iVipId);
                if ($pay_log && $member_identify && $handle_count) {
                    DB::commit();
                    return redirect('/member');
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
