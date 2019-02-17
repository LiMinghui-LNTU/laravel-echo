<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        if ($sRes == '1005'){
            Session::flash('error', '该账号已存在');
            return redirect()->back()->withInput();
        }elseif($sRes == '1004'){
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

    //消息列表
    public function messageList()
    {
        $sTitle = '消息列表';
        $sidebar = $this->sidebar;
        $content = 'admin.shopowner.message-list';
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content'));
    }

    //发型展示列表
    public function caseShow()
    {
        return 'hello';
    }
}
