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

    /**
     * 获取某造型师所有订单
     */
    public static function getAllOrdersByDesignerId($iDesignerId = 0)
    {
        $oOrders = self::leftJoin('members as m', 'member_id', '=', 'm.id')->leftJoin('vip as v', 'm.vip_id', '=', 'v.id')
            ->select('orders.id', 'order_number', 'm.nickname', 'v.title', 'service_number', 'total_money', 'status', 'pay', 'm.account_number', 'is_read', 'orders.created_at')
            ->where('designer_id', $iDesignerId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return $oOrders;
    }

    /**
     * 根据订单号查询订单
     */
    public static function getOrderByOrderNum($sNum = '')
    {
        return self::where('order_number', $sNum)->first();
    }

    /**
     * 查询某造型师新订单的数量
     */
    public static function searchNewOrderNum($iDsignerId = 0)
    {
        return self::where('designer_id', $iDsignerId)->where('is_read', 0)->get()->count();
    }

    /**
     * 根据id查询订单
     */
    public static function getOrderById($iId = 0)
    {
        return self::where('id', $iId)->first();
    }

    /**
     * 修改订单已读状态
     */
    public static function changeReadById($iId = 0)
    {
        return self::where('id', $iId)->update(['is_read' => 1]);
    }
}