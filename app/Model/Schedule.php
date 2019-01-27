<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2019/1/27
 * Time: 18:49
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $table = 'schedule';

    protected $guarded = ['deleted_at'];

    /**
     * 获取5天内的日程安排
     */
    public static function getScheduleById($iDesigner_id = 0)
    {
        $sStartTime = date('Y-m-d') . " 08:00:00";
        $sEndTime = date('Y-m-d H:i:s', strtotime($sStartTime) + 60 * 60 * 24 * 4 + 60 * 60 * 14);
        $aData = self::select('title', 'start', 'end', 'text_color', 'background_color')->where('designer_id', $iDesigner_id)->whereBetween('start', [$sStartTime, $sEndTime])->get();
        $aRes = [];
        foreach ($aData as $data) {
            $aTemp = [];
            $aTemp['title'] = $data->title;
            $aTemp['start'] = $data->start;
            $aTemp['end'] = $data->end;
            $aTemp['textColor'] = $data->text_color;
            $aTemp['backgroundColor'] = $data->background_color;
            $aTemp['block'] = true;
            array_push($aRes, $aTemp);
        }
        return $aRes;
    }

    /**
     * 获取指定造型师日程表
     */
    public static function getScheduleListById($iDesigner_id = 0)
    {
        return self::where('designer_id', $iDesigner_id)->paginate(5);
    }

    /**
     * 保存日程
     */
    public static function saveSchedule($aInput = null)
    {
        $aData = [
            'setter_id' => $aInput['setter_id'],
            'setter_type' => $aInput['setter_type'],
            'designer_id' => $aInput['designer_id'],
            'title' => $aInput['title'],
            'start' => $aInput['start'],
            'end' => $aInput['end'],
            'text_color' => $aInput['text_color'],
            'background_color' => $aInput['background_color'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        $bRes = self::insert($aData);
        if (!$bRes) {
            return '1004';
        }
        return '1001';
    }
}