<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2019/3/11
 * Time: 17:35
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoinLog extends Model
{
    use SoftDeletes;

    protected $table = 'coins_log';

    protected $guarded = ['id', 'deleted_at'];

    /**
     * 检查某人当天是否还可获得发币
     * 每人每天最多获取10个，每篇文章每天只可获取1次
     */
    public static function allowSend($iMemberId = 0, $iArticleId = 0)
    {
        $query = self::whereDate('created_at', date('Y-m-d'))->where('member_id', $iMemberId);
        $iTotalCoins = $query->sum('coins');
        if ($iTotalCoins > 10) {
            return false;
        } else {
            $oLog = $query->where('article_id', $iArticleId)->first();
            if ($oLog) {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * 增加日志
     */
    public static function addCoinLog($iMemberId = 0, $iArticleId = 0, $iCoins = 0)
    {
        return self::insert(['member_id' => $iMemberId, 'article_id' => $iArticleId, 'coins' => $iCoins, 'created_at' => date('Y-m-d H:i:s')]);
    }

}