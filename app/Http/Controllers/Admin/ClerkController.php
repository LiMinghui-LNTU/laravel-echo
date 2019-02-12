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
use App\Model\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClerkController extends Controller
{
    private $sViewPath = 'admin.';
    private $sidebar = 'admin.layout.sidebar3';
    protected $oUser;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->oUser = Auth::user();
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
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sTitle = '日程管理';
        $sidebar = $this->sidebar;
        $content = 'admin.clerk.calendar';
        //获取本人id
        $iDesignerId = Designer::getDesignerIdByUserId($this->oUser->id);
        //获取日程
        $oSchedule = json_encode(Schedule::getScheduleById($iDesignerId), true);
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oSchedule'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aInput = $request->all();
        $iDesignerId = Designer::getDesignerIdByUserId($this->oUser->id);
        $aData = [
            'setter_id' => $iDesignerId[0],
            'setter_type' => 1,
            'designer_id' => $iDesignerId[0],
            'title' => $aInput['title'],
            'start' => date('Y-m-d H:i:s', strtotime($aInput['start']) - 60 * 60 * 8),
            'end' => date('Y-m-d H:i:s', strtotime($aInput['end']) - 60 * 60 * 8),
            'text_color' => 'green',
            'background_color' => 'lightblue',
        ];
        //保存
        $sCode = Schedule::saveSchedule($aData);
        return json_encode(['code' => $sCode]);
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

    //日程列表
    public function calendarList()
    {
        $sTitle = '日程列表';
        $sidebar = $this->sidebar;
        $content = 'admin.clerk.calendar-list';
        //获取本人id
        $iDesignerId = Designer::getDesignerIdByUserId($this->oUser->id);
        //获取日程
        $oSchedule = Schedule::getScheduleListById($iDesignerId);
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oSchedule'));
    }

}