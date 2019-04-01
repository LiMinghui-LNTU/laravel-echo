<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayLog extends Model
{
    use SoftDeletes;

    protected $table = 'pay_log';

    protected $guarded = ['id', 'deleted_at'];

    /**
     * 插入日志
     */
    public static function addPayLog($iMemberId = 0, $out_trade_no = '', $total_amount = 0, $subject = '')
    {
        $data = [
            'member_id'=>$iMemberId,
            'ip'=>Recruit::getIp(),
            'out_trade_no'=>$out_trade_no,
            'total_amount'=>$total_amount,
            'subject'=>$subject,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        return self::insert($data);
    }
}
