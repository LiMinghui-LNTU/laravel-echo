<?php

namespace App\Http\Controllers\Admin;

use App\Model\Recruit;
use App\Model\Resume;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ResumeController extends Controller
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
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sTitle = '应聘简历';
        $sidebar = $this->sidebar;
        $content = 'admin.resume.index';
        //获取该职位下所有简历
        $oResumes = Resume::getResumesByRecruitId($id);
        if (is_null($oResumes)) {
            Session::flash('warning', '职位参数非法');
            return redirect()->back();
        } else {
            $oRecruit = Recruit::getInfoById($id);
            $sTitle = $oRecruit->position . '--' . $sTitle;
            return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oResumes'));
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
        //
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
        //
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
        $oResume = Resume::getResumeById($iId);
        if (is_null($oResume) || $iId != $id) {
            return json_encode(['code' => 1004, 'msg' => '此简历不存在或已删除']);
        } else {
            Resume::destroy($iId);
            //删除文件
            $file = $_SERVER['DOCUMENT_ROOT'] . $oResume->url;
            if(file_exists($file)){
                unlink($file);
            }
            Recruit::updateCount($oResume->recruit_id, 0);
            return json_encode(['code' => 1001, 'msg' => '删除成功']);
        }
    }
}
