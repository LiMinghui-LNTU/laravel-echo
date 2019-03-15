<?php

namespace App\Model;

use Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sowmap extends Model
{
    use SoftDeletes;

    protected $table = 'sowmap';

    protected $guarded = ['id', 'deleted_at'];

    /**
     * 验证
     */
    public static function sowmapValid($aData = null)
    {
        $rules = [
            'thumb'=>'required',
            'redirect'=>'required'
        ];

        $messages = [
            'thumb.required'=>'轮播图片必传',
            'redirect.required'=>'请选择跳转模块'
        ];

        return Validator::make($aData, $rules, $messages);
    }

    /**
     * 取出轮播图
     */
    public static function getSowmap()
    {
        return self::orderBy('updated_at', 'desc')->get();
    }

    /**
     * 保存轮播图
     */
    public static function saveSowmap($aData = null)
    {
        $aData['created_at'] = date('Y-m-d H:i:s');
        $aData['updated_at'] = date('Y-m-d H:i:s');
        return self::insert($aData);
    }

    /**
     * 轮播图优先显示
     */
    public static function preShow($iId = 0)
    {
        return self::where('id', $iId)->update(['updated_at'=>date('Y-m-d H:i:s')]);
    }

    /**
     * 更新数据
     */
    public static function updateSowmap($iId = 0, $aData = null)
    {
        return self::where('id', $iId)->update($aData);
    }

    /**
     * 获取单个轮播图
     */
    public static function getSowmapById($iId = 0)
    {
        return self::where('id', $iId)->first();
    }
}
