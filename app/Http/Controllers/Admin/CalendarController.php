<?php

namespace App\Http\Controllers\Admin;

use App\Model\Designer;
use App\Model\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sTitle = '日程列表';
        $sidebar = $this->sidebar;
        $content = 'admin.calendar.index';
        //获取日程
        $oSchedule = Schedule::getScheduleListById($this->iDesignerId);
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oSchedule'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sTitle = '添加日程';
        $sidebar = $this->sidebar;
        $content = 'admin.calendar.create';
        if (count($this->iDesignerId)) {
            //获取日程
            $oSchedule = json_encode(Schedule::getScheduleById($this->iDesignerId), true);
            return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oSchedule'));
        } else {
            return redirect('/admin/clerk/' . $this->oUser->id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aInput = $request->all();
        $aData = [
            'setter_id' => $this->iDesignerId[0],
            'setter_type' => 1,
            'designer_id' => $this->iDesignerId[0],
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
