<?php
/**
 * Created by PhpStorm.
 * User: liminghui
 * Date: 2019/1/15
 * Time: 18:05
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $guarded = ['deleted_at'];

    /**
     * 根据预订人id查询订单
     */
    public static function getOrdersByMemberId($iId = 0)
    {
        return self::where('member_id', $iId)->get();
    }

    /**
     * 生成订单号
     */
    public static function createOrderNumber($iLength = 0)
    {
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $sNumber = '';
        for ($i = $iLength; $i > 0; $i--) {
            $sNumber .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return "JY" . $sNumber;
    }

    /**
     * 订单入库
     */
    public static function saveTheOrder($aData = null)
    {
        $bRes = self::insert($aData);
        if (!$bRes) {
            return '1004';
        }
        return '1001';
    }
}