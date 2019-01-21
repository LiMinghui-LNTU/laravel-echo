<?php
/**
 * Created by PhpStorm.
 * User: liminghui
 * Date: 2019/1/15
 * Time: 18:06
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $table = 'services';

    protected $guarded = ['deleted_at'];

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
}