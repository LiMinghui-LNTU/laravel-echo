<?php

namespace App\Http\Controllers\Admin;

use App\Model\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sTitle = '消息列表';
        $sidebar = $this->sidebar;
        $content = 'admin.message.index';
        //查询消息接受者为店长且发送给id为2（店长）的消息
        $oMyMessages = Message::getMessagesSentToMe(2, 2);
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oMyMessages'));
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
        //
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

    //ajax获取某人发送给我的消息
    public function getMessageToMe(Request $request)
    {
        $iFrom = $request->input('from');
        $iPreType = $request->input('pre_type');
        if (is_null($iFrom) || is_null($iPreType)) {
            return json_encode(['code' => 1010, 'msg' => '错误的消息来源']);
        } else {
            //获取消息
            $oMessages = Message::getMessages($iFrom, $iFrom, $iPreType, $iPreType);
            if (is_null($oMessages)) {
                return json_encode(['code' => 1010, 'msg' => '消息数据丢失啦']);
            } else {
                return json_encode(['code' => 1001, 'msg' => (string)view($this->sViewPath . 'message.message-content-all', compact('oMessages'))]);
            }
        }
    }
}
