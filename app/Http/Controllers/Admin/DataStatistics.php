<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2019/4/20
 * Time: 14:31
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Designer;
use App\Model\Order;
use App\Model\Vip;
use Illuminate\Support\Facades\Auth;

class DataStatistics extends Controller
{
    private $sViewPath = 'admin.';
    private $sidebar = 'admin.layout.sidebar2';
    protected $oUser;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->oUser = Auth::user();
            if ($this->oUser->role_id == 2) {
                return $next($request);
            } else {
                abort(404);
            }
        });
    }
    
    //店员业绩统计
    public function achievementsStatistic()
    {
        $sTitle = '业绩统计';
        $sidebar = $this->sidebar;
        $content = 'admin.statistics.achievement-chart';
        $sData = implode(',',Designer::getAchievementData());
        $sNames = json_encode(Designer::getAllStringName());
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'sNames', 'sData'));
    }

    //顾客类型统计
    public function customersTypeStatistic()
    {
        $sTitle = '顾客统计';
        $sidebar = $this->sidebar;
        $content = 'admin.statistics.type-chart';
        $sVipNames = json_encode(Vip::getVipTitle());
        $sData = implode(',', Vip::statisticCount());
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'sVipNames', 'sData'));
    }
    
    //统计顾客流量
    public function statisticVisitors()
    {
        $sTitle = '服务量统计';
        $sidebar = $this->sidebar;
        $content = 'admin.statistics.visitors-chart';
        //计算截止今日的顾客访问数据
        $aData = Order::getOrdersArr();
        $sData = json_encode($aData);
        //计算一个最大访问量作为日历显示标准
        $iMax = 0;
        foreach ($aData as $k=>$v){
            $iMax = max($iMax, $v[1]);
        }
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'sData', 'iMax'));
    }
}