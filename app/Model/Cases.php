<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2019/2/24
 * Time: 12:02
 */

namespace App\Model;


use Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cases extends Model
{
    use SoftDeletes;

    protected $table = 'case';

    protected $guarded = ['deleted_at'];

    /**
     * 新增验证
     */
    public static function caseValid($aData = null)
    {
        $rules = [
            'tag' => 'required',
            'thumb' => 'required',
            'title' => 'required',
            'content' => 'required'
        ];
        $messages = [
            'tag.required' => '发型标签必选',
            'thumb.required' => '缩略图必传',
            'title.required' => '发型标题必填',
            'content.required' => '内容介绍必填'
        ];
        return Validator::make($aData, $rules, $messages);
    }

    /**
     * 保存发型案例
     */
    public static function saveCase($aData = null)
    {
        $aData['created_at'] = date('Y-m-d H:i:s');
        return self::insert($aData);
    }

    /**
     * 更新发型案例
     */
    public static function updateCase($iId = 0, $aData = null)
    {
        $aData['updated_at'] = date('Y-m-d H:i:s');
        return self::where('id', $iId)->update($aData);
    }

    /**
     * 根据id获取某个发型案例
     */
    public static function getCaseById($iId = 0)
    {
        return self::where('id', $iId)->first();
    }

    /**
     * 前台获取所有发型案例
     */
    public static function getCases()
    {
        return self::where('is_show', 1)->orderBy('created_at', 'desc')->get();
    }

    /**
     * 切换显示状态
     */
    public static function switchShowState($iId = 0, $iState = 0)
    {
        return self::where('id', $iId)->update(['is_show' => $iState]);
    }

    /**
     * 查询所有数据
     */
    public static function getAllCases()
    {
        return self::orderBy('created_at', 'desc')->paginate(5);
    }
}