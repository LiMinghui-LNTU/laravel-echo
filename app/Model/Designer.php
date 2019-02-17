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
use Validator;

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

    /**
     * 验证新增店员
     */
    public static function clerkValid($aData = null)
    {
        $rules = [
            'name' => 'required',
            'sex' => 'required',
            'photo' => 'required',
            'title' => 'required',
            'work_year' => 'required',
            'introduction' => 'required'
        ];
        $message = [
            'name.required'=>'请输入姓名',
            'sex.required'=>'请选择性别',
            'photo.required'=>'请上传写真',
            'title.required'=>'请输入头衔',
            'work_year.required'=>'请输工龄',
            'introduction.required'=>'请输个人简介'
        ];
        return Validator::make($aData, $rules, $message);
    }

    /**
     * 保存数据
     */
    public static function saveClerk($aData = null)
    {
        $aData['stars'] = 1;
        $aData['created_at'] = date('Y-m-d H:i:s');
        return self::insert($aData);
    }
}