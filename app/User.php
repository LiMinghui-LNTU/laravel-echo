<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
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

}