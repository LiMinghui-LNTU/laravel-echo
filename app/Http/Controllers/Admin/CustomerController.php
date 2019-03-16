<?php

namespace App\Http\Controllers\Admin;

use App\Model\Members;
use App\Model\Vip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
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
    public function index(Request $request)
    {
        $sTitle = '顾客列表';
        $sidebar = $this->sidebar;
        $content = 'admin.customer.index';
        $iVip = is_null($request->input('vip')) ? 0 : (int)$request->input('vip');
        $sKey = is_null($request->input('key')) ? '' : trim($request->input('key'));
        //获取所有注册顾客
        $oCustomers = Members::getCustomers($iVip, $sKey);
        //获取VIP信息
        $oVip = Vip::getVipInfo();
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oCustomers', 'oVip', 'iVip', 'sKey'));
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
    public function destroy($id)
    {
        //
    }
}
