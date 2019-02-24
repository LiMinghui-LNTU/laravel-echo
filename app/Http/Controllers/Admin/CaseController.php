<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cases;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            'tag'=>trim($request->input('tag')),
            'thumb'=>trim($request->input('file_thumb')),
            'title'=>trim($request->input('title')),
            'content'=>trim($request->input('content'))
        );
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
}
