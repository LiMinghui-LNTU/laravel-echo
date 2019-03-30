<?php

namespace App\Http\Controllers\Admin;

use App\Model\Vip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VipController extends Controller
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
        $sTitle = '会员管理';
        $sidebar = $this->sidebar;
        $content = 'admin.vip.index';
        //获取VIP
        $oVips = Vip::getVips();
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oVips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sTitle = '添加会员卡';
        $sidebar = $this->sidebar;
        $content = 'admin.vip.create';
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'title' => trim($request->input('title')),
            'picture' => $request->input('picture'),
            'charge' => $request->input('charge'),
            'privilege' => $request->input('privilege'),
            'discount' => $request->input('discount'),
            'reputation_value' => $request->input('reputation_value'),
            'coins' => $request->input('coins')
        );
        //验证
        $validator = Vip::vipValidate($data);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //保存数据
            $bRes = Vip::saveVip($data);
            if ($bRes) {
                return redirect('/admin/vip');
            } else {
                Session::flash('error', '保存失败');
                return redirect()->back()->withInput();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sTitle = '会员卡编辑';
        $sidebar = $this->sidebar;
        $content = 'admin.vip.edit';
        //获取会员
        $oVip = Vip::getVipById($id);
        if (is_null($oVip)) {
            Session::flash('error', '该会员卡不存在或已删除');
            return redirect()->back();
        } else {
            return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oVip'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array(
            'title' => trim($request->input('title')),
            'picture' => $request->input('picture'),
            'charge' => $request->input('charge'),
            'privilege' => $request->input('privilege'),
            'discount' => $request->input('discount'),
            'reputation_value' => $request->input('reputation_value'),
            'coins' => $request->input('coins')
        );
        //验证
        $validator = Vip::vipValidate($data);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //更新数据
            $iRes = Vip::updateVip($id, $data);
            if ($iRes) {
                return redirect('/admin/vip');
            } else {
                Session::flash('error', '更新失败');
                return redirect()->back()->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $iId = $request->input('id');
        $oVip = Vip::getVipById($id);
        if (is_null($oVip) || $iId != $id) {
            return json_encode(['code' => 1004, 'msg' => '此会员卡不存在或已删除']);
        } else {
            Vip::destroy($iId);
            return json_encode(['code' => 1001, 'msg' => '删除成功']);
        }
    }
}
