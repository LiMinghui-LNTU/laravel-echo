<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2019/2/24
 * Time: 12:02
 */

namespace App\Model;


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

    }

    /**
     * 查询所有数据
     */
    public static function getAllCases()
    {
        return self::orderBy('created_at', 'desc')->paginate(5);
    }
}