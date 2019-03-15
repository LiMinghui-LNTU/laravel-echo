<?php

namespace App\Http\Controllers\Admin;

use App\Model\Navigation;
use App\Model\Sowmap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SowmapController extends Controller
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
        $sTitle = '首页轮播图';
        $sidebar = $this->sidebar;
        $content = 'admin.sowmap.index';
        //获取全部轮播图
        $oSowmaps = Sowmap::getSowmap();
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oSowmaps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sTitle = '新增轮播图';
        $sidebar = $this->sidebar;
        $content = 'admin.sowmap.create';
        //获取导航
        $oNav = Navigation::getAllNavigation();
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oNav'));
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
            'redirect' => trim($request->input('redirect')),
            'thumb' => trim($request->input('thumb'))
        );
        //验证
        $validator = Sowmap::sowmapValid($data);
        if ($validator->fails()) {
            Session::flash('warning', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //保存数据
            $bRes = Sowmap::saveSowmap($data);
            if ($bRes) {
                return redirect('/admin/sowmap');
            } else {
                Session::flash('warning', '保存失败');
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
        $oSowmap = Sowmap::getSowmapById($id);
        if(is_null($oSowmap)){
            Session::flash('warning', '置顶失败');
            return redirect()->back();
        }else{
            //更新时间
            Sowmap::preShow($id);
            return redirect('/admin/sowmap');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sTitle = '编辑轮播图';
        $sidebar = $this->sidebar;
        $content = 'admin.sowmap.edit';
        //获取导航
        $oNav = Navigation::getAllNavigation();
        //获取轮播图
        $oSowmap = Sowmap::getSowmapById($id);
        if (is_null($oSowmap)) {
            Session::flash('warning', '该轮播图不存在或已删除');
            return redirect()->back();
        } else {
            return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oNav', 'oSowmap'));
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
            'redirect' => trim($request->input('redirect')),
            'thumb' => trim($request->input('thumb'))
        );
        //验证
        $validator = Sowmap::sowmapValid($data);
        if ($validator->fails()) {
            Session::flash('warning', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //更新数据
            $iRes = Sowmap::updateSowmap($id, $data);
            if ($iRes) {
                return redirect('/admin/sowmap');
            } else {
                Session::flash('warning', '更新失败');
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
        $oSowmap = Sowmap::getSowmapById($iId);
        if (is_null($oSowmap) || $iId != $id) {
            return json_encode(['code' => 1004, 'msg' => '此轮播图不存在或已删除']);
        } else {
            Sowmap::destroy($iId);
            return json_encode(['code' => 1001, 'msg' => '删除成功']);
        }
    }
}
