<?php

namespace App\Http\Controllers\Admin;

use App\Model\Members;
use App\Model\Vip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
    public function create(Request $request)
    {
        //此方法用作顾客数据导出
        $iVip = (int)$request->input('vip');
        $sKey = trim($request->input('key'));
        //查询数据构建数组
        $oData = Members::getExportData($iVip, $sKey);
        Excel::create('顾客注册数据' . date('YmdHis'), function ($excel) use ($oData) {
            $excel->sheet('数据明细', function ($sheet) use ($oData) {
                $sheet->rows($oData);
                //设置标题
                $sheet->prependRow(1, array('Id', '账号', '昵称', '头衔', '发币', '信誉值', '账户余额', '注册时间', '是否激活'));
            });
        })->export('xlsx');
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
