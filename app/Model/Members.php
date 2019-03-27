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
     * 根据id获取姓名
     */
    public static function getNameById($iId = 0)
    {
        return self::where('id', $iId)->pluck('nickname');
    }

    /**
     * 判断账户是否已注册
     */
    public static function isRegister($account = '')
    {
        $obj = self::where('account_number', $account)->first();
        if (is_null($obj)) {
            return 0;
        } else {
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
        if ($is_reg) {
            return false;
        } else {
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
        if (is_null($obj)) {
            return 1002;
        } else {
            //校验密码
            if (Hash::check($password, $obj->password)) {
                if ($obj->is_active) {
                    return 1001;
                } else {
                    return 1003;
                }
            } else {
                return 1002;
            }
        }
    }

    /**
     * 根据账号查询个人信息
     */
    public static function getInfoByAccount($sAccount = '')
    {
        return self::leftJoin('vip as v', 'vip_id', '=', 'v.id')->select('members.id', 'account_number', 'nickname', 'photo', 'title', 'members.coins', 'members.reputation_value', 'balance')->where('account_number', $sAccount)->first();
    }

    /**
     * 根据id查询顾客
     */
    public static function getMemberById($iId = 0)
    {
        return self::where('id', $iId)->first();
    }

    /**
     * 根据账户获取id
     */
    public static function getIdByAccount($sAccount = '')
    {
        return self::where('account_number', $sAccount)->pluck('id');
    }

    /**
     * 增加发币
     * iType:0扣除 1增加
     */
    public static function sendCoins($iId = 0, $iCoins = 0, $iType = 0)
    {
        if ($iType) {
            return self::where('id', $iId)->increment('coins', $iCoins);
        } else {
            return self::where('id', $iId)->decrement('coins', $iCoins);
        }
    }

    /**
     * 后台获取顾客信息
     */
    public static function getCustomers($iVip = 0, $sKey = '')
    {
        $res = self::leftJoin('vip as v', 'vip_id', '=', 'v.id')
            ->select('members.id', 'account_number', 'nickname', 'title', 'members.coins', 'members.reputation_value', 'balance', 'members.created_at')
            ->where(function ($query) use ($sKey) {
                $query->where('nickname', 'like', '%' . $sKey . '%')
                    ->orWhere('account_number', 'like', '%' . $sKey . '%');
            });
        if ($iVip == 0) {
            return $res->paginate(10);
        } else {
            return $res->where('vip_id', $iVip)->paginate(10);
        }
    }

    /**
     * 为数据导出构建数组
     */
    public static function getExportData($iVip = 0, $sKey = '')
    {
        $res = self::leftJoin('vip as v', 'vip_id', '=', 'v.id')
            ->select('members.id', 'account_number', 'nickname', 'title', 'members.coins', 'members.reputation_value', 'balance', 'members.created_at')
            ->where(function ($query) use ($sKey) {
                $query->where('nickname', 'like', '%' . $sKey . '%')
                    ->orWhere('account_number', 'like', '%' . $sKey . '%');
            });
        if ($iVip == 0) {
            return $res->get()->toArray();
        } else {
            return $res->where('vip_id', $iVip)->get()->toArray();
        }
    }

    /**
     * 更新发币数量
     */
    public static function updateCoins($iId = 0, $iTicketType = 0, $iQuota = 0)
    {
        if ($iTicketType == 2) { //兑换代金券消耗1000个发币
            return self::sendCoins($iId, 1000, 0);
        } elseif ($iTicketType == 5) { //领取发币券增加iQuota个发币
            return self::sendCoins($iId, $iQuota, 1);
        } else {
            return 1;
        }
    }

    /**
     * 获取发币
     */
    public static function getCoinsById($iId = 0)
    {
        return self::where('id', $iId)->pluck('coins')[0];
    }
}