<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function getAllUser()
    {
        return self::orderBy('created_at', 'desc')->get();
    }

    public static function findUser($id = 0)
    {
        return self::where('id', $id)->first();
    }

    public static function identifyValid($data = [])
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ];
        $message = [
            'username.required' => '请输入账号',
            'password.required' => '请输入密码',
            'role.required' => '请选择身份',
        ];
        return Validator::make($data, $rules, $message);
    }

    /**
     * 取出所有店员
     */
    public static function getAllClerks()
    {
        return self::where('role_id', 3)->paginate(5);
    }

    /**
     * 店员入库
     */
    public static function saveClerk($aInput = null)
    {
        $iHas = self::where('username', trim($aInput['username']))->count();
        if ($iHas == 0) {
            $aData = [
                'username' => trim($aInput['username']),
                'password' => Hash::make(trim($aInput['password'])),
                'head_url' => '/assets/img/default.png',
                'role_id' => 3,
                'email' => $aInput['email'],
                'phone' => $aInput['phone'],
                'created_at' => date('Y-m-d H:i:s')
            ];
            $bRes = self::insert($aData);
            if ($bRes) {
                return '1001';
            } else {
                return '1004';
            }
        } else {
            return '1005';
        }
    }

    /**
     * 根据id查询身份
     */
    public static function getRoleById($iId = 0)
    {
        return self::where('id', $iId)->pluck('role_id');
    }

    /**
     * 根据id查用户名
     */
    public static function getUsernameById($iId = 0)
    {
        return self::where('id', $iId)->pluck('username');
    }

    /**
     * 新增验证
     */
    public static function addValidate($aData = null)
    {
        $rules = [
            'username'=>'required',
            'password'=>'required',
            'role_id'=>'required',
        ];
        $messages = [
            'username.required'=>'用户名必填',
            'password.required'=>'密码必填',
            'role_id.required'=>'角色必选',
        ];
        return Validator::make($aData, $rules, $messages);
    }
    
    /**
     * 获取所有管理员及店长
     */
    public static function getAllAdministrators()
    {
        return self::where('id', '<>', Auth::User()->id)->whereIn('role_id', [1, 2])->paginate(10);
    }

    /**
     * 人员入库
     */
    public static function saveAdministrator($aData = null)
    {
        $aData['created_at'] = date('Y-m-d H:i:s');
        $aData['password'] = Hash::make($aData['password']);
        return self::insert($aData);
    }

    /**
     * 根据id获取用户
     */
    public static function getUserById($iId = 0)
    {
        return self::where('id', $iId)->first();
    }

    /**
     * 获取用户密码
     */
    public static function getUserPassword($iId = 0)
    {
        return self::where('id', $iId)->pluck('password')[0];
    }

    /**
     * 修改用信息
     */
    public static function updateUserInfo($iId = 0, $sColumn = '', $sValue = '')
    {
        return self::where('id', $iId)->update([$sColumn=>$sValue, 'updated_at'=>date('Y-m-d H:i:s')]);
    }

}