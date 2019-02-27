<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cases;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CaseController extends Controller
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
        $sTitle = '发型展示列表';
        $sidebar = $this->sidebar;
        $content = 'admin.case.index';
        //获取全部展示发型
        $oCases = Cases::getAllCases();
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oCases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sTitle = '新增发型';
        $sidebar = $this->sidebar;
        $content = 'admin.case.create';
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
        $data = array(
            'tag' => trim($request->input('tag')),
            'thumb' => trim($request->input('thumb')),
            'title' => trim($request->input('title')),
            'content' => trim($request->input('content'))
        );
        //验证
        $validator = Cases::caseValid($data);
        if ($validator->fails()) {
            Session::flash('warning', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //保存数据
            $bRes = Cases::saveCase($data);
            if ($bRes) {
                return redirect('/admin/case');
            } else {
                Session::flash('warning', '保存失败');
                return redirect()->back()->withInput();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $oCase = Cases::getCaseById($id);
        $iState = $request->input('state');
        if (is_null($id) || is_null($oCase) || is_null($iState)) {
            return json_encode(['code' => 1005, 'msg' => '该发型不存在或已删除']);
        } else {
            //切换显示状态
            $iRes = Cases::switchShowState($id, $iState);
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sTitle = '发型编辑';
        $sidebar = $this->sidebar;
        $content = 'admin.case.edit';
        //获取这个发型案例
        $oCase = Cases::getCaseById($id);
        if (is_null($oCase)) {
            Session::flash('warning', '该案例不存在或已删除');
            return redirect()->back();
        } else {
            return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oCase'));
        }
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
        $data = array(
            'tag' => trim($request->input('tag')),
            'thumb' => trim($request->input('thumb')),
            'title' => trim($request->input('title')),
            'content' => trim($request->input('content'))
        );
        //验证
        $validator = Cases::caseValid($data);
        if ($validator->fails()) {
            Session::flash('warning', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //更新数据
            $iRes = Cases::updateCase($id, $data);
            if ($iRes) {
                return redirect('/admin/case');
            } else {
                Session::flash('warning', '更新失败');
                return redirect()->back()->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $iId = $request->input('id');
        $oCase = Cases::getCaseById($iId);
        if (is_null($oCase) || $iId != $id) {
            return json_encode(['code' => 1004, 'msg' => '此案例不存在或已删除']);
        } else {
            Cases::destroy($iId);
            return json_encode(['code' => 1001, 'msg' => '删除成功']);
        }
    }
}
