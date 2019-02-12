<?php
/**
 * Created by PhpStorm.
 * User: liminghui
 * Date: 2019/1/15
 * Time: 18:07
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designer extends Model
{
    use SoftDeletes;

    protected $table = 'designers';

    protected $guarded = ['deleted_at'];

    /**
     * 获取全部理发师
     */
    public static function getAllDesigners()
    {
        return self::orderBy('created_at', 'desc')->get();
    }

    /**
     * 根据后台用户id获取对应前台造型师id
     */
    public static function getDesignerIdByUserId($iUserId = 0)
    {
        return self::where('user_id', $iUserId)->pluck('id');
    }

    /**
     * 根据id获取造型师名称
     */
    public static function getDesignerNameById($iId = 0)
    {
        return self::where('id', $iId)->pluck('name');
    }

    /**
     * 根据后台用户id获取造型师
     */
    public static function getDesignerByUserId($iUserId = 0)
    {
        return self::where('user_id', $iUserId)->first();
    }
}