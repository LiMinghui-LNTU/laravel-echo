<?php

namespace App\Model;

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
            'picture'=>'required',
            'type'=>'required',
            'quota'=>'required',
            'count'=>'required',
            'condition'=>'required',
            'created_at'=>'required'
        ];
        $messages = [
            'picture.required'=>'请上传券面图片',
            'type.required'=>'请选择票券类型',
            'quota.required'=>'请设置面额',
            'count.required'=>'请设置发券数量',
            'condition.required'=>'请规定领取条件',
            'created_at.required'=>'请填写发券时间'
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
        return self::groupBy('type')->get();
    }

    /**
     * 根据票券类型获取剩余量
     */
    public static function getCountByType($iType = 0)
    {
        return self::where('type', $iType)->sum('remain');
    }

    /**
     * 查询某类型票券是否已存在
     */
    public static function ticketExist($iType = 0)
    {
        return self::where('type', $iType)->where('remain', '>', 0)->first();
    }
}
