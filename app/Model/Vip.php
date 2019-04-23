<?php
/**
 * Created by PhpStorm.
 * User: liminghui
 * Date: 2019/1/15
 * Time: 18:03
 */

namespace App\Model;


use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vip extends Model
{
    use SoftDeletes;

    protected $table = 'vip';

    protected $guarded = ['id', 'deleted_at'];

    /**
     * 添加验证
     */
    public static function vipValidate($aData = null)
    {
        $rules = [
            'title'=>'required',
            'picture'=>'required',
            'charge'=>'required',
            'privilege'=>'required',
            'discount'=>'required',
            'reputation_value'=>'required',
            'coins'=>'required'
        ];
        $messages = [
            'title.required'=>'请填写卡片名称',
            'picture.required'=>'请上传会员卡片',
            'charge.required'=>'请设置办理金额',
            'privilege.required'=>'请填写会员特权',
            'discount.required'=>'请设置消费折扣',
            'reputation_value.required'=>'请设置信誉值奖励',
            'coins.required'=>'请设置发币奖励'
        ];
        return Validator::make($aData, $rules, $messages);
    }

    /**
     * 数据入库
     */
    public static function saveVip($aData = null)
    {
        $aData['created_at'] = date('Y-m-d H:i:s');
        return self::insert($aData);
    }

    /**
     * 更新数据
     */
    public static function updateVip($iId = 0, $aData = null)
    {
        $aData['updated_at'] = date('Y-m-d H:i:s');
        return self::where('id', $iId)->update($aData);
    }

    /**
     * 根据会员id获取会员头衔
     */
    public static function getTitleById($iId = 1)
    {
        return self::where('id', $iId)->pluck('title');
    }

    /**
     * 获取所有VIP信息
     */
    public static function getVipInfo()
    {
        return self::orderBy('created_at', 'desc')->get();
    }

    /**
     * 会员管理--获取VIP数据
     */
    public static function getVips()
    {
        return self::where('id', '<>', 1)->orderBy('created_at', 'desc')->get();
    }

    /**
     * 根据id获取会员
     */
    public static function getVipById($iId = 0)
    {
        return self::where('id', $iId)->first();
    }

    /**
     * 增加会员办理人数
     */
    public static function updateVipHandleCount($iId = 0)
    {
        return self::where('id', $iId)->increment('handle_count');
    }

    /**
     * 获取VIP名称数组
     */
    public static function getVipTitle()
    {
        return array_column(self::select('title')->orderBy('id', 'asc')->get()->toArray(), 'title');
    }

    /**
     * 统计每种VIP下顾客办理人数
     */
    public static function statisticCount()
    {
        $oData = self::leftJoin('members as m', 'vip.id', '=', 'm.vip_id')
            ->select('title', 'vip_id', DB::raw('COUNT(*) as num'))
            ->groupBy('vip_id')
            ->orderBy('vip.id', 'asc')
            ->get();
        $aData = [];
        foreach ($oData as $data){
            $temp['value'] = $data->num;
            $temp['name'] = $data->title;
            array_push($aData, json_encode($temp));
        }
        return $aData;
    }
}