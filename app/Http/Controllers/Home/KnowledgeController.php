<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2018/12/30
 * Time: 21:59
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Model\CoinLog;
use App\Model\Knowledge;
use App\Model\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KnowledgeController extends Controller
{
    private $sViewPath = 'home.knowledge.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sTitle = '养护知识';
        $oArticles = Knowledge::getSomeArticle(1, 8);
        return view($this->sViewPath . 'index', compact('sTitle', 'oArticles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //此方法用作前台加载更多
        $iPage = (int)$request->input('page');
        if (!is_numeric($iPage)) {
            return json_encode(['code' => 1013, 'msg' => '无效的页码']);
        } else {
            $oArticles = Knowledge::getSomeArticle($iPage, 8);
            return json_encode(['code' => 1001, 'msg' => (string)view($this->sViewPath . 'content', compact('oArticles')), 'count' => count($oArticles)]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sTitle = '文章详情';
        $iSent = 0; //是否发放发币
        //增加阅读量
        if (!is_null($id)) {
            Knowledge::incrementViewCount($id);
        }
        //查询该文章
        $oArticle = Knowledge::getArticleById($id);
        $account = session()->get('member');
        if (!is_null($account)) {
            //获取登录顾客id
            $iId = Members::getIdByAccount($account[0])[0];
            if (CoinLog::allowSend($iId, $oArticle->id)) {
                //发放发币
                $iSent = Members::sendCoins($iId, $oArticle->coins, 1);
                //记录发放日志
                CoinLog::addCoinLog($iId, $oArticle->id, $oArticle->coins);
            }
        }
        if (is_null($oArticle)) {
            abort(404);
        } else {
            return view($this->sViewPath . 'detail', compact('sTitle', 'oArticle', 'iSent'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}