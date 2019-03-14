<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resume extends Model
{
    use SoftDeletes;

    protected $table = 'resumes';

    protected $guarded = ['id', 'deleted_at'];

    /**
     * 数据入库
     */
    public static function saveResume($aData = null)
    {
        $aData['created_at'] = date('Y-m-d H:i:s');
        return self::insert($aData);
    }

    /**
     * 判断某人是否提交过该职位的简历
     */
    public static function isSubmit($iInfoId)
    {
        $ip = Recruit::getIp();
        $oResume = self::where('recruit_id', $iInfoId)->where('ip', $ip)->first();
        if (is_null($oResume)){
            return false;
        }else{
            return true;
        }
    }

    /**
     * 获取某职位下所有简历
     */
    public static function getResumesByRecruitId($iRecruitId = 0)
    {
        return self::where('recruit_id', $iRecruitId)->orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * 根据简历id获取简历
     */
    public static function getResumeById($iId = 0)
    {
        return self::where('id', $iId)->first();
    }
}
