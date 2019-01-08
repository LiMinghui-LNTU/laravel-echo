<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2018/12/26
 * Time: 13:25
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'role';

    protected $fillable = ['name', 'created_at'];

    protected $guarded = ['deleted_at'];

    /**
     * 角色添加验证
     * @param array $data待验证数据
     * @return mixed
     */
    public static function addValid($data = [])
    {
        $rules = [
            'name' => 'required',
        ];
        $message = [
            'name.required' => '请填写角色名称'
        ];
        return Validator::make($data, $rules, $message);
    }

    /**
     * 获取全部角色
     * @return mixed
     */
    public static function getAllRoles()
    {
        $oRole = self::select('id', 'name')->get();
        return $oRole;
    }
}