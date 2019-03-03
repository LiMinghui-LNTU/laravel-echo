<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2019/1/26
 * Time: 23:09
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Designer;
use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClerkController extends Controller
{
    private $sViewPath = 'admin.';
    private $sidebar = 'admin.layout.sidebar3';
    protected $oUser;
    protected $iDesignerId;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->oUser = Auth::user();
            $this->iDesignerId = Designer::getDesignerIdByUserId($this->oUser->id);
            if ($this->oUser->role_id == 3) {
                return $next($request);
            } else {
                abort(404);
            }
        });
    }

    public function index()
    {
        $sTitle = '我的订单';
        $sidebar = $this->sidebar;
        $content = 'admin.clerk.order';
        if (count($this->iDesignerId)) { //已经完善个人信息成为造型师
            //获取本人所有订单
            $oOrders = Order::getAllOrdersByDesignerId($this->iDesignerId);
            return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oOrders'));
        } else {
            return redirect('/admin/clerk/' . $this->oUser->id);
        }
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
        $content = 'clerk.order-content';
        //提醒成功后通过ajax将数据回显页面
        $oOrders = Order::getAllOrdersByDesignerId($this->iDesignerId);
        if ($oOrders) {
            return json_encode(['code' => 1001, 'msg' => (string)view($this->sViewPath . $content, compact('oOrders'))]);
        } else {
            return json_encode(['code' => 1010, 'msg' => '空数据']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sTitle = '个人信息';
        $sidebar = $this->sidebar;
        $content = 'admin.clerk.info';
        if ($id != $this->oUser->id) {
            return redirect('/admin/clerk/' . $this->oUser->id);
        }
        $oDesigner = Designer::getDesignerByUserId($id);
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oDesigner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $iId = (int)$request->input('order_id');
        //点击单号修改订单已读状态
        $oOrder = Order::getOrderById($id);
        if (is_null($oOrder) || $id != $iId) {
            return json_encode(['code' => 1011, 'msg' => '订单不存在']);
        } else {
            //修改订单已读状态
            $iRes = Order::changeReadById($oOrder->id);
            if ($iRes) {
                return json_encode(['code' => 1001, 'msg' => $oOrder->order_number]);
            } else {
                return json_encode(['code' => 1012, 'msg' => '数据更新失败']);
            }
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
            'user_id' => $id,
            'name' => trim($request->input('name')),
            'sex' => trim($request->input('gander')),
            'photo' => trim($request->input('photo')),
            'title' => trim($request->input('title')),
            'work_year' => trim($request->input('work_year')),
            'introduction' => trim($request->input('introduction'))
        );
        $validator = Designer::clerkValid($data);
        if ($validator->fails()) {
            Session::flash('warning', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //保存数据
            $bRes = Designer::saveClerk($id, $data);
            if ($bRes) {
                return redirect('/admin/clerk');
            } else {
                Session::flash('warning', '保存失败');
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
    public function destroy($id)
    {
        //
    }

}