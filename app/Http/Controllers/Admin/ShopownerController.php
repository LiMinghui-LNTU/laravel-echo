<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessageEvent;
use App\Events\PublicMessageEvent;
use App\Http\Controllers\Controller;
use App\Model\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ShopownerController extends Controller
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

    public function index()
    {
        $sTitle = '员工列表';
        $sidebar = $this->sidebar;
        $content = 'admin.shopowner.clerk-list';
        //取出店员
        $oUser = User::getAllClerks();
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sTitle = '新增店员';
        $sidebar = $this->sidebar;
        $content = 'admin.shopowner.clerk-create';
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aData = $request->all();
        //保存数据
        $sRes = User::saveClerk($aData);
        if ($sRes == '1005') {
            Session::flash('error', '该账号已存在');
            return redirect()->back()->withInput();
        } elseif ($sRes == '1004') {
            Session::flash('error', '入库失败');
            return redirect()->back()->withInput();
        }
        return redirect('/admin/shopowner');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    //店长回复消息
    public function replyMessage(Request $request)
    {
        //获取消息接收方
        $iTo = (int)$request->input('to');
        $iType = (int)$request->input('type');
        $sContent = trim($request->input('content'));
        if (is_null($iTo) || is_null($iType) || is_null($sContent)) {
            return json_encode(['code' => 1013, 'msg' => '非法参数']);
        } else {
            //构建消息并保存
            $aMessage = array(
                'from' => 2,
                'to' => $iTo,
                'content' => $sContent,
                'pre_type' => 2,
                'type' => $iType,
                'created_at' => date('Y-m-d H:i:s')
            );
            $iId = Message::saveMessage($aMessage);
            $oMessages = Message::getMessageById($iId);
            //广播消息：回复顾客在公共频道，其他人在私有频道
            if($oMessages->type == 4){
                broadcast(new PublicMessageEvent($oMessages));
            }else{
                broadcast(new MessageEvent($oMessages));
            }
            return json_encode(['code' => 1001, 'msg' => (string)view($this->sViewPath . 'message.message-content', compact('oMessages'))]);
        }
    }
}
