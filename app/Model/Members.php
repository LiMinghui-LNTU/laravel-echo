<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2019/1/12
 * Time: 17:56
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Members extends Model
{
    use SoftDeletes;

    protected $table = 'members';

    protected $guarded = ['deleted_at'];

    /**
     * 判断账户是否已注册
     */
    public static function isRegister($account = '')
    {
        $obj = self::where('account_number',$account)->first();
        if(is_null($obj)){
            return 0;
        }else{
            return 1;
        }
    }

    /**
     * 会员注册
     */
    public static function saveMember($account = '', $password = '', $regist_type = 1)
    {
        //判断是否已注册
        $is_reg = self::isRegister($account);
        if($is_reg){
            return false;
        }else {
            $data = ['account_number' => $account, 'password' => Hash::make($password), 'regist_type' => $regist_type, 'created_at' => date('Y-m-d H:i:s')];
            return self::insert($data);
        }
    }

    /**
     * 登录验证
     */
    public static function checkAccount($account = '', $password = '')
    {
        $obj = self::where('account_number', $account)->first();
        if(is_null($obj)){
            return 1002;
        }else{
            //校验密码
            if(Hash::check($password, $obj->password)){
                if($obj->is_active){
                    return 1001;
                }else{
                    return 1003;
                }
            }else{
                return 1002;
            }
        }
    }
}