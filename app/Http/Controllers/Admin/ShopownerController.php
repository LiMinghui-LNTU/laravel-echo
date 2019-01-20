<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopownerController extends Controller
{
    private $sViewPath = 'admin.';
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
        $sTitle = '店长首页';
        $sidebar = 'admin.layout.sidebar2';
        $content = 'admin.shopowner.content';
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content'));
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

    //消息列表
    public function messageList()
    {
        $sTitle = '消息列表';
        $sidebar = 'admin.layout.sidebar2';
        $content = 'admin.shopowner.message-list';
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content'));
    }
}
