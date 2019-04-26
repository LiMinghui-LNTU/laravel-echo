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
use Illuminate\Support\Facades\DB;

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
    
    /*
     * 带条件查询订单
     */
    public static function getOrdersLimitedByCondition($iDesignerId = 0, $iCondition = 0, $sKey = '')
    {
        $oData = self::leftJoin('members as m', 'member_id', '=', 'm.id')->leftJoin('vip as v', 'm.vip_id', '=', 'v.id')
            ->select('orders.id', 'order_number', 'm.nickname', 'v.title', 'service_number', 'total_money', 'status', 'pay', 'm.account_number', 'is_read', 'orders.created_at')
            ->where('designer_id', $iDesignerId);
        if($iCondition != 0){
            $k = ''; $v = 0;
            switch ((int)$iCondition){
                case 1:$k = 'status';$v = 1;break;
                case 2:$k = 'status';$v = 2;break;
                case 3:$k = 'status';$v = 3;break;
                case 4:$k = 'pay';$v = 1;break;
                case 5:$k = 'pay';$v = 0;break;
                case 6:$k = 'pay';$v = 2;break;
            }
            $oData = $oData->where($k, $v);
        }
        if($sKey != null){
            $oData = $oData->where(function ($query) use ($sKey){
                $query->where('order_number', 'like', '%' . $sKey . '%');
            })->orWhere(function ($query) use ($sKey){
                $query->where('nickname', 'like', '%' . $sKey . '%');
            });
        }
        return $oData->orderBy('created_at', 'desc')->paginate(10);
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

    /**
     * 根据造型师id按月查询本年所有已完成订单
     */
    public static function getOrdersOfMonthByDesignerId($iDesignerId = 0)
    {
        $data = self::where('designer_id', $iDesignerId)
            ->where('status', 1)
            ->whereYear('created_at', date('Y', time()))
            ->selectRaw('MONTH(created_at) as date,COUNT(*) as value')
            ->groupBy('date')
            ->get();
        $temp = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($data as $d){
            $temp[$d->date-1] = $d->value;
        }
        return $temp;
    }
    
    /**
     * 获取当前年份1月1日起到现在每天顾客的订单量数组
     */
    public static function getOrdersArr()
    {
        $start = strtotime(date('Y', time()).'-01-01');
        $end = strtotime(date('Y-m-d', time()));
        $oData = self::select(DB::raw('date_format(created_at,\'%Y-%m-%d\') as date'), DB::raw('COUNT(*) as num'))
            ->where('status', 1)
            ->whereYear('created_at', date('Y', time()))
            ->groupBy('date')
            ->get();
        $aResult = [];
        while ($end >= $start){
            $temp[0] = date('Y-m-d', $start);
            foreach ($oData as $data){
                if($start == strtotime($data->date)){
                    $temp[1] = $data->num;
                    break;
                }else{
                    $temp[1] = 0;
                }
            }
            $start += 3600 * 24;
            array_push($aResult, $temp);
        }
        return $aResult;
    }

}