<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class OrderComment extends Model
{
    use  SoftDeletes;

    protected $table = 'order_comments';

    protected $guarded = ['id', 'deleted_at'];

    /**
     * 插入评价数据
     */
    public static function addComment($iMemberId = 0, $iOrderId = 0, $iScore = 0)
    {
        //根据订单id查询订单对应的造型师
        $iDesignerId = Order::getDesignerIdByOrderId($iOrderId);
        return self::insert(['member_id'=>$iMemberId, 'order_id'=>$iOrderId, 'designer_id'=>$iDesignerId, 'score'=>$iScore, 'created_at'=>date('Y-m-d H:i:s')]);
    }

    /**
     * 根据订单id查询该订单的评分
     */
    public static function getScoreByOrderId($iOrderId = 0)
    {
        return self::where('order_id', $iOrderId)->pluck('score');
    }

    /**
     * 根据造型师id计算该造型师的平均分值
     */
    public static function getAvgScoreByDesignerId($iDesignerId = 0)
    {
        return self::where('designer_id', $iDesignerId)->avg('score');
    }
}
