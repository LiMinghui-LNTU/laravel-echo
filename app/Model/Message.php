<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    use SoftDeletes;

    protected $table = 'message';

    protected $guarded = ['id', 'deleted_at'];

    /**
     * 获取消息
     * form:消息发送者id
     * to:消息接收者id
     * preType:消息发送者身份（1管理员 2店长 3店员 4顾客）
     * type:消息接收者身份（1管理员 2店长 3店员 4顾客）
     */
    public static function getMessages($from = 0, $to = 0, $preType = 0, $type = 0)
    {
        return self::where(function ($query) use ($from, $preType) {
            $query->where('from', $from)->where('pre_type', $preType);
        })->orWhere(function ($query) use ($to, $type) {
            $query->where('to', $to)->where('type', $type);
        })->orderBy('created_at')->get();
    }

    /**
     * 根据id获取消息对象
     */
    public static function getMessageById($iId = 0)
    {
        return self::where('id', $iId)->first();
    }

    /**
     * 保存消息并返回消息id
     */
    public static function saveMessage($aData = null)
    {
        return self::insertGetId($aData);
    }

    /**
     * 查询发送给某人的所有消息，合并相同的发送者
     */
    public static function getMessagesSentToMe($to = 0, $type = 0)
    {
        return self::where('to', $to)->where('type', $type)->groupBy('from')
            ->select('from', 'pre_type', 'content', 'created_at', DB::raw('COUNT(*) - SUM(is_read) as need_read'))
            ->orderByDesc('created_at')->get();
    }
}
