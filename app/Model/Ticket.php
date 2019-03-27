<?php

namespace App\Model;

use ArrayObject;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $table = 'tickets';

    protected $guarded = ['id', 'deleted_at'];

    /**
     * 添加验证
     */
    public static function ticketValid($aData = null)
    {
        $rules = [
            'picture' => 'required',
            'type' => 'required',
            'quota' => 'required',
            'count' => 'required',
            'condition' => 'required',
            'created_at' => 'required'
        ];
        $messages = [
            'picture.required' => '请上传券面图片',
            'type.required' => '请选择票券类型',
            'quota.required' => '请设置面额',
            'count.required' => '请设置发券数量',
            'condition.required' => '请规定领取条件',
            'created_at.required' => '请填写发券时间'
        ];
        return Validator::make($aData, $rules, $messages);
    }

    /**
     * 保存票券
     */
    public static function saveTicket($aData = null)
    {
        return self::insert($aData);
    }

    /**
     * 后台获取所有票券
     */
    public static function getAllTickets()
    {
        return self::orderBy('created_at', 'desc')->get();
    }

    /**
     * 根据id获取票券
     */
    public static function getTicketById($iId = 0)
    {
        return self::where('id', $iId)->first();
    }

    /**
     * 修改票券
     */
    public static function updateTicket($iId = 0, $aData = null)
    {
        $aData['updated_at'] = date('Y-m-d H:i:s');
        return self::where('id', $iId)->update($aData);
    }

    /**
     * 前台获取票券
     */
    public static function getTickets()
    {
        return self::where('remain', '>', 0)->groupBy('type')->get();
    }

    /**
     * 获取票券剩余量
     */
    public static function getTicketRemain($iType = 0, $sCreated_at = '')
    {
        return self::where('type', $iType)->where('created_at', $sCreated_at)->sum('remain');
    }

    /**
     * 查询某类型票券是否已存在
     */
    public static function ticketExist($iType = 0)
    {
        return self::where('type', $iType)->where('remain', '>', 0)->first();
    }

    /**
     * 获取随机票券的id/remain数组
     */
    public static function getTicketInfoArr($iType = 0, $sCreatedAt = '', $sColumn = '')
    {
        $query = self::where('type', $iType)->where('remain', '>', 0);
        if ($iType == 3) { //限时券
            return json_decode($query->where('created_at', $sCreatedAt)->orderBy('quota', 'asc')->pluck($sColumn), true);
        } else { //月券、发币券
            return json_decode($query->orderBy('quota', 'asc')->pluck($sColumn), true);
        }
    }

    /**
     * 减少被领券的数量
     */
    public static function updateTicketNum($iTicketId = 0)
    {
        return self::where('id', $iTicketId)->decrement('remain');
    }

    /**
     * 按比例抽取随机券
     */
    public static function luckDraw($iType = 0, $sCreatedAt = '')
    {
        //获取剩余随机卡id数组
        $aId = self::getTicketInfoArr($iType, $sCreatedAt, 'id');
        //获取剩余随机卡数量数组
        $aRemain = self::getTicketInfoArr($iType, $sCreatedAt, 'remain');
        if (count($aId) == 0 || count($aRemain) == 0) {
            return 0;
        } else {
            $total_arr = [];
            for ($i = 0; $i < count($aId); $i++) {
                $temp = array_fill(0, $aRemain[$i], $aId[$i]);
                $total_arr = array_merge($total_arr, $temp);
            }
            return $total_arr[mt_rand(0, count($total_arr) - 1)];
        }
    }

    /**
     * 发放票券
     */
    public static function sendTicket($iMemberId = 0, $iTicketId = 0, $iQuota = 0, $iTicketType = 0)
    {
        //开启事务，客户领券、数量更新、领券记录同成同败
        DB::beginTransaction();
        try {
            $update_coins = Members::updateCoins($iMemberId, $iTicketType, $iQuota);
            $decrement_ticket = self::updateTicketNum($iTicketId);
            $ticket_log = TicketLog::addTicketLog($iMemberId, $iTicketId, $iTicketType);
            if ($update_coins && $decrement_ticket && $ticket_log) {
                DB::commit();
                return json_encode(['code' => 1001, 'msg' => '领取成功', 'type' => 1, 'quota' => $iQuota]);
            } else {
                return json_encode(['code' => 1015, 'msg' => '1015领取失败']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode(['code' => 1015, 'msg' => '1016领取失败']);
        }
    }
}
