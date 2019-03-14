<?php

namespace App\Http\Controllers\Admin;

use App\Model\Recruit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RecruitController extends Controller
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
        $sTitle = '招聘启事列表';
        $sidebar = $this->sidebar;
        $content = 'admin.recruit.index';
        //获取全部招聘启事
        $oInfo = Recruit::getAllRecruitInfo();
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sTitle = '新增招聘信息';
        $sidebar = $this->sidebar;
        $content = 'admin.recruit.create';
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
            'position' => trim($request->input('position')),
            'thumb' => trim($request->input('thumb')),
            'content' => $request->input('content'),
        );
        //验证
        $validator = Recruit::recruitValid($data);
        if ($validator->fails()) {
            Session::flash('warning', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //保存数据
            $bRes = Recruit::saveInfo($data);
            if ($bRes) {
                return redirect('/admin/recruit');
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
    public function show($id, Request $request)
    {
        $oInfo = Recruit::getInfoById($id);
        $iState = $request->input('state');
        if (is_null($id) || is_null($oInfo) || is_null($iState)) {
            return json_encode(['code' => 1005, 'msg' => '该招聘信息不存在或已删除']);
        } else {
            //切换显示状态
            $iRes = Recruit::switchSendState($id, $iState);
            if ($iRes) {
                return json_encode(['code' => 1001, 'msg' => '切换成功']);
            } else {
                return json_encode(['code' => 1004, 'msg' => '更新失败']);
            }
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
        $sTitle = '编辑招聘信息';
        $sidebar = $this->sidebar;
        $content = 'admin.recruit.edit';
        //获取该则招聘信息
        $oInfo = Recruit::getInfoById($id);
        if (is_null($oInfo)) {
            Session::flash('warning', '该信息不存在或已删除');
            return redirect()->back();
        } else {
            return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oInfo'));
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
            'position' => trim($request->input('position')),
            'thumb' => trim($request->input('thumb')),
            'content' => $request->input('content'),
        );
        //验证
        $validator = Recruit::recruitValid($data);
        if ($validator->fails()) {
            Session::flash('warning', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //更新数据
            $iRes = Recruit::updateInfo($id, $data);
            if ($iRes) {
                return redirect('/admin/recruit');
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
    public function destroy($id)
    {
        //
    }
}
