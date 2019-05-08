<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class TicketLog extends Model
{
    use SoftDeletes;

    protected $table = 'ticket_log';

    protected $guarded = ['id', 'deleted_at'];

    /**
     * 判断某人是否领过某种券
     */
    public static function hasLog($sAccount = '', $iType = 0, $sCreated_at = '')
    {
        $iMemberId = Members::getIdByAccount($sAccount);
        if($iType == 3){ //是否获得过限时券
            $oLogs = self::where('member_id', $iMemberId)->where('ticket_type', $iType)->orderBy('created_at', 'desc')->first();
            if(is_null($oLogs)){
                return false;
            }else{
                $oTicket = Ticket::getTicketById($oLogs->ticket_id);
                if($sCreated_at == $oTicket->created_at){
                    return true;
                }else{
                    return false;
                }
            }
        }elseif ($iType == 1){ //是否领取过新人券
            $oLog = self::where('member_id', $iMemberId)->where('ticket_type', 1)->first();
            if(is_null($oLog)){
                return false;
            }else{
                return true;
            }
        }elseif ($iType == 4){ //是否领取了月券
            $oLog = self::where('member_id', $iMemberId)->where('ticket_type', 4)->whereMonth('created_at', date('m'))->first();
            if(is_null($oLog)){
                return false;
            }else{
                return true;
            }
        }else{ //是否获得过发币券
            $oLog = self::where('member_id', $iMemberId)->where('ticket_type', 5)->whereDate('created_at', date('Y-m-d'))->first();
            if(is_null($oLog)){
                return false;
            }else{
                return true;
            }
        }
    }
    
    /**
     * 增加领券记录
     */
    public static function addTicketLog($iMemberId = 0, $iTicketId = 0, $iTicketType = 0)
    {
        return self::insert(['member_id'=>$iMemberId, 'ticket_id'=>$iTicketId, 'ticket_type'=>$iTicketType, 'created_at'=>date('Y-m-d H:i:s')]);
    }

    /**
     * 根据顾客id获取其未使用的票券
     */
    public static function getUnUsedTicketById($iMemberId = 0)
    {
        return self::leftJoin('tickets as t', 'ticket_id', '=', 't.id')
            ->where('member_id', $iMemberId)
            ->where('is_use', 0)
            ->where('ticket_type', '<>', 5)
            ->select('t.type', 't.quota', DB::raw('count(*) as num'))
            ->groupBy('t.type', 't.quota')
            ->get();
    }

    /**
     * 计算票券张数
     */
    public static function calculateTicketsNum($iMenberId = 0)
    {
        return self::where('member_id', $iMenberId)->where('ticket_type', '<>', 5)->where('is_use', 0)->get()->count();
    }

    /**
     * 根据票券类型及面额获取票券领取id
     */
    public static function getTicketLogId($iType = 0, $iQuota = 0, $iSkpi = 0, $iTake = 0)
    {
        return self::leftJoin('tickets as t', 'ticket_id', '=', 't.id')
            ->where('t.type', $iType)
            ->where('t.quota', $iQuota)
            ->where('is_use', 0)
            ->select('ticket_log.id')
            ->orderBy('ticket_log.created_at', 'asc')
            ->skip($iSkpi)->take($iTake)
            ->get()->toArray();
    }

    /**
     * 更新票券使用状态
     */
    public static function useTickets($aTicketsId = null)
    {
        return self::whereIn('id', $aTicketsId)->update(['is_use'=>1]);
    }
}
