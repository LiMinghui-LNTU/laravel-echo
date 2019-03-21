<?php
/**
 * Created by PhpStorm.
 * User: liminghui
 * Date: 2019/1/15
 * Time: 18:06
 */

namespace App\Model;


use Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $table = 'services';

    protected $guarded = ['deleted_at'];

    /**
     * 新增验证
     */
    public static function serviceValid($aData = null, $iFlag = 0)
    {
        $rules = [
            'number'=>'required',
            'name'=>'required',
            'type'=>'required',
            'price'=>'required',
            'continue_to'=>'required',
            'introduction'=>'required',
            'reputation_val'=>'required'
        ];
        $messages = [
            'number.required'=>'请填写服务单号',
            'name.required'=>'请填写服务名称',
            'type.required'=>'请设置服务类型',
            'price.required'=>'请设置价位',
            'continue_to.required'=>'请设置服务时长',
            'introduction.required'=>'请填写服务简介',
            'reputation_val.required'=>'请设置信誉值'
        ];
        if($iFlag == 1){
            //新增验证
            $rules['number'] = 'required|unique:services,number';
            $messages['number.unique'] = '服务单号必须唯一';
        }
        return Validator::make($aData, $rules, $messages);
    }

    /**
     * 获取所有服务项目
     * type为头发类型 1-短发 2-长发
     */
    public static function getServices($type = 1)
    {
        $oNames = self::select('name')->groupBy('name')->orderBy('id')->get();
        $data = [];
        foreach ($oNames as $obj){
            $data[$obj->name] = self::where('name',$obj->name)->where('type',$type)->orderBy('price')->get();
        }
        return $data;
    }

    /**
     * 根据服务单号获取服务
     */
    public static function getServiceByNum($sNum = '')
    {
        return self::where('number', $sNum)->first();
    }

    /**
     * 根据服务单号获取服务名称
     */
    public static function getServiceNameByNum($sNum = '')
    {
        return self::where('number', $sNum)->pluck('name');
    }

    /**
     * 根据单号计算信誉值
     */
    public static function calculateReputationValue($aNumber = null)
    {
        return self::whereIn('number', $aNumber)->sum('reputation_val');
    }

    /**
     * 获取服务名称
     */
    public static function getServiceNames()
    {
        return self::select('name')->groupBy('name')->get();
    }

    /**
     * 根据服务名称查询服务信息
     */
    public static function getServiceByName($sName = '')
    {
        return self::where('name', $sName)->get();
    }

    /**
     * 根据名称获取单号最大的服务
     */
    public static function getLastServer($sName = '')
    {
        return self::where('name', $sName)->orderBy('number', 'desc')->first();
    }

    /**
     * 保存服务
     */
    public static function saveService($aData = null)
    {
        $aData['created_at'] = date('Y-m-d H:i:s');
        return self::insert($aData);
    }

    /**
     * 更新服务
     */
    public static function updateService($iId = 0, $aData = null)
    {
        $aData['updated_at'] = date('Y-m-d H:i:s');
        return self::where('id', $iId)->update($aData);
    }

    /**
     * 根据id查询服务
     */
    public static function getServiceById($iId = 0)
    {
        return self::where('id', $iId)->first();
    }
}