<?php

namespace App\Model;

use Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recruit extends Model
{
    use SoftDeletes;

    protected $table = 'recruit';

    protected $guarded = ['id', 'deleted_at'];

    /**
     * 添加验证
     */
    public static function recruitValid($data = null)
    {
        $rules = [
            'position' => 'required',
            'thumb' => 'required',
            'content' => 'required'
        ];

        $messages = [
            'position.required' => '请填写招聘职位',
            'thumb.required' => '请上传职位缩略图',
            'content.required' => '请填写招聘内容',
        ];

        return Validator::make($data, $rules, $messages);
    }

    /**
     * 获取所有招聘信息
     */
    public static function getAllRecruitInfo()
    {
        return self::orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * 保存数据
     */
    public static function saveInfo($aData = null)
    {
        $aData['created_at'] = date('Y-m-d H:i:s');
        return self::insert($aData);
    }

    /**
     * 根据id获取对应招聘信息
     */
    public static function getInfoById($iId = 0)
    {
        return self::where('id', $iId)->first();
    }

    /**
     * 更新招聘信息
     */
    public static function updateInfo($iId = 0, $aData = null)
    {
        $aData['updated_at'] = date('Y-m-d H:i:s');
        return self::where('id', $iId)->update($aData);
    }

    /**
     * 切换招聘信息发布状态
     */
    public static function switchSendState($iId = 0, $iState = 0)
    {
        return self::where('id', $iId)->update(['is_send' => $iState]);
    }

    /**
     * 前台获取所有发布的招聘信息
     */
    public static function getSentInfo()
    {
        return self::where('is_send', 1)->orderBy('created_at', 'desc')->get();
    }

    /**
     * 更新投简历人数
     */
    public static function updateCount($iId = 0, $iFlag = 0)
    {
        if($iFlag){
            return self::where('id', $iId)->increment('count');
        }else{
            return self::where('id', $iId)->decrement('count');
        }
    }

    /**
     * 获取客户端ip
     */
    public static function getIp()
    {
        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : 'unknown';
    }
}
