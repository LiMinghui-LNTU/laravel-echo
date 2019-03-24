<?php

namespace App\Http\Controllers\Admin;

use App\Model\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TicketController extends Controller
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
        $sTitle = '票券管理';
        $sidebar = $this->sidebar;
        $content = 'admin.ticket.index';
        //获取所有票券
        $oTickets = Ticket::getAllTickets();
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oTickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sTitle = '发放票券';
        $sidebar = $this->sidebar;
        $content = 'admin.ticket.create';
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
            'picture' => $request->input('picture'),
            'type' => $request->input('type'),
            'quota' => $request->input('quota'),
            'count' => $request->input('count'),
            'remain' => $request->input('count'),
            'condition' => trim($request->input('condition')),
            'created_at' => trim($request->input('created_at'))
        );
        //验证
        $validator = Ticket::ticketValid($data);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //保存数据
            $bRes = Ticket::saveTicket($data);
            if ($bRes) {
                return redirect('/admin/ticket');
            } else {
                Session::flash('error', '保存失败');
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
        $sTitle = '编辑票券';
        $sidebar = $this->sidebar;
        $content = 'admin.ticket.edit';
        //获取票券
        $oTicket = Ticket::getTicketById($id);
        if (is_null($oTicket)) {
            Session::flash('error', '该票券不存在或已删除');
            return redirect()->back();
        } else {
            return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oTicket'));
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
            'picture' => $request->input('picture'),
            'type' => $request->input('type'),
            'quota' => $request->input('quota'),
            'count' => $request->input('count'),
            'condition' => trim($request->input('condition')),
            'created_at' => trim($request->input('created_at'))
        );
        //验证
        $validator = Ticket::ticketValid($data);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //更新数据
            $iRes = Ticket::updateTicket($id, $data);
            if ($iRes) {
                return redirect('/admin/ticket');
            } else {
                Session::flash('error', '更新失败');
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
        $oTicket = Ticket::getTicketById($id);
        if (is_null($oTicket) || $iId != $id) {
            return json_encode(['code' => 1004, 'msg' => '此票券不存在或已删除']);
        } else {
            Ticket::destroy($iId);
            return json_encode(['code' => 1001, 'msg' => '删除成功']);
        }
    }

    public function isExist(Request $request)
    {
        $iType = (int)$request->input('type');
        if (in_array($iType, [1, 2, 3, 4, 5])) {
            $oTicket = Ticket::ticketExist($iType);
            if (is_null($oTicket)) {
                return json_encode(['code' => 1001, 'is_exist' => 0]);
            } else {
                return json_encode(['code' => 1001, 'is_exist' => 1, 'condition' => $oTicket->condition, 'created_at' => (string)$oTicket->created_at]);
            }
        } else {
            return json_encode(['code' => 1013, 'msg' => '无效参数']);
        }
    }
}
