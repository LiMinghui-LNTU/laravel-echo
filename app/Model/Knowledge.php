<?php

namespace App\Model;

use Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Knowledge extends Model
{
    use SoftDeletes;

    protected $table = 'knowledge';

    protected $guarded = ['id', 'deleted_at'];

    /**
     * 添加验证
     */
    public static function knowledgeValid($aData = null)
    {
        $rules = [
            'title'=>'required',
            'thumb'=>'required',
            'description'=>'required',
            'content'=>'required',
            'coins'=>'required'
        ];
        $messages = [
            'title.required'=>'请填写标题',
            'thumb.required'=>'请上传缩略图',
            'description.required'=>'请填写描述',
            'content.required'=>'请填写文章内容',
            'coins.required'=>'请设置发币',
        ];
        return Validator::make($aData, $rules, $messages);
    }

    /**
     * 获取所有文章
     */
    public static function getAllArticles()
    {
        return self::orderBy('created_at','desc')->paginate(10);
    }

    /**
     * 保存文章
     */
    public static function saveArticle($aData = null)
    {
        $aData['created_at'] = date('Y-m-d H:i:s');
        return self::insert($aData);
    }

    /**
     * 根据id查询文章
     */
    public static function getArticleById($iId = 0)
    {
        return self::where('id', $iId)->first();
    }

    /**
     * 更新数据
     */
    public static function updateArticle($iId = 0, $aData = null)
    {
        $aData['updated_at'] = date('Y-m-d H:i:s');
        return self::where('id', $iId)->update($aData);
    }
}
