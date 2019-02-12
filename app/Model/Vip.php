<?php
/**
 * Created by PhpStorm.
 * User: liminghui
 * Date: 2019/1/15
 * Time: 18:03
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vip extends Model
{
    use SoftDeletes;

    protected $table = 'vip';

    protected $guarded = ['deleted_at'];

    /**
     * 根据会员id获取会员头衔
     */
    public static function getTitleById($iId = 1)
    {
        return self::where('id', $iId)->pluck('title');
    }
}