<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2018/12/30
 * Time: 21:30
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Model\Members;
use App\Model\Ticket;
use App\Model\TicketLog;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    private $sViewPath = 'home.activity.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sTitle = '优惠活动';
        //获取优惠券
        $oTickets = Ticket::getTickets();
        return view($this->sViewPath . 'index', compact('sTitle', 'oTickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //此方法改做领取票券逻辑
        $iType = (int)$request->input('type');
        if (is_null(session()->get('member'))){
            return json_encode(['code'=>1014,'msg'=>'请先登录！']);
        }else{
            $iMemberId = Members::getIdByAccount(session()->get('member'))[0];
            switch ($iType){
                case 1: //新人券
                    if(TicketLog::hasLog(session()->get('member'), 1)){
                        return json_encode(['code'=>1015, 'msg'=>'您已领过新人券']);
                    }else{
                        $oTicket = Ticket::ticketExist(1);
                        if(is_null($oTicket)){
                            return json_encode(['code'=>1015, 'msg'=>'新人券已领完']);
                        }else{
                            return Ticket::sendTicket($iMemberId, $oTicket->id, $oTicket->quota, 1);
                        }
                    }
                    break;
                case 2: //代金券
                    $iCoins = Members::getCoinsById($iMemberId);
                    if ($iCoins < 1000){
                        return json_encode(['code'=>1015, 'msg'=>'您的发币不足']);
                    }else{
                        $oTicket = Ticket::ticketExist(2);
                        if(is_null($oTicket)){
                            return json_encode(['code'=>1015, 'msg'=>'代金券已领完']);
                        }else{
                            return Ticket::sendTicket($iMemberId, $oTicket->id, $oTicket->quota, 2);
                        }
                    }
                    break;
                case 3: //限时券
                    $sCreated_at = (string)$request->input('time');
                    if(TicketLog::hasLog(session()->get('member'), 3, $sCreated_at)){
                        return json_encode(['code'=>1015, 'msg'=>'本期已抢']);
                    }else{
                        //随机抽取一张随机券（按剩余券比例）
                        $iTicketId = Ticket::luckDraw(3, $sCreated_at);
                        $oTicket = Ticket::getTicketById($iTicketId);
                        if ($iTicketId == 0){
                            return json_encode(['code'=>1015, 'msg'=>'本期券已领完']);
                        }else{
                            //发放票券
                            return Ticket::sendTicket($iMemberId, $iTicketId, $oTicket->quota, 3);
                        }
                    }
                    break;
                case 4: //月券
                    if(TicketLog::hasLog(session()->get('member'), 3)){
                        return json_encode(['code'=>1015, 'msg'=>'本月已领']);
                    }else{
                        //随机抽取一张随机券（按剩余券比例）
                        $iTicketId = Ticket::luckDraw(4);
                        $oTicket = Ticket::getTicketById($iTicketId);
                        if ($iTicketId == 0){
                            return json_encode(['code'=>1015, 'msg'=>'月券已抢空']);
                        }else{
                            //发放票券
                            return Ticket::sendTicket($iMemberId, $iTicketId, $oTicket->quota, 4);
                        }
                    }
                    break;
                default: //发币券
                    if(TicketLog::hasLog(session()->get('member'), 5)){
                        return json_encode(['code'=>1015, 'msg'=>'今天已领']);
                    }else{
                        //随机抽取一张随机券（按剩余券比例）
                        $iTicketId = Ticket::luckDraw(5);
                        $oTicket = Ticket::getTicketById($iTicketId);
                        if ($iTicketId == 0){
                            return json_encode(['code'=>1015, 'msg'=>'发币券已抢空']);
                        }else{
                            //发放票券
                            return Ticket::sendTicket($iMemberId, $iTicketId, $oTicket->quota, 5);
                        }
                    }
                    break;
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}