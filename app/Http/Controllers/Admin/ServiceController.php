<?php

namespace App\Http\Controllers\Admin;

use App\Model\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ServiceController extends Controller
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
        $sTitle = '服务列表';
        $sidebar = $this->sidebar;
        $content = 'admin.service.index';
        //获取所有服务名
        $oServiceNames = Service::getServiceNames();
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oServiceNames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sTitle = '新增服务项目';
        $sidebar = $this->sidebar;
        $content = 'admin.service.create';
        $sName = $request->input('name');
        //获取该服务单号最大的一个
        $oService = Service::getLastServer($sName);
        if(is_null($oService)){
            Session::flash('warning', '非法参数，无该项服务');
            return redirect()->back();
        }else{
            $sNumber = 'jyfy' . (string)((int)substr($oService->number, 4) + 1);
            return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'sName', 'sNumber'));
        }
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
            'number' => trim($request->input('number')),
            'name' => trim($request->input('name')),
            'type' => trim($request->input('type')),
            'price' => trim($request->input('price')),
            'continue_to' => trim($request->input('time')),
            'reputation_val' => trim($request->input('reputation')),
            'introduction' => trim($request->input('introduction')),
        );
        //验证
        $validator = Service::serviceValid($data, 1);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //保存数据
            $bRes = Service::saveService($data);
            if ($bRes) {
                return redirect('/admin/service/'.trim($request->input('name')));
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
        $sTitle = '服务项目--' . $id;
        $sidebar = $this->sidebar;
        $content = 'admin.service.detail';
        $oServices = Service::getServiceByName($id);
        if (count($oServices) == 0) {
            Session::flash('warning', '非法参数，无该项服务');
            return redirect()->back();
        } else {
            return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oServices'));
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
        $sTitle = '编辑服务';
        $sidebar = $this->sidebar;
        $content = 'admin.service.edit';
        //获取该服务
        $oService = Service::getServiceById($id);
        if (is_null($oService)) {
            Session::flash('error', '该服务不存在或已删除');
            return redirect()->back();
        } else {
            return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oService'));
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
            'number' => trim($request->input('number')),
            'name' => trim($request->input('name')),
            'type' => trim($request->input('type')),
            'price' => trim($request->input('price')),
            'continue_to' => trim($request->input('time')),
            'reputation_val' => trim($request->input('reputation')),
            'introduction' => trim($request->input('introduction')),
        );
        //验证
        $validator = Service::serviceValid($data, 2);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //更新数据
            $iRes = Service::updateService($id, $data);
            if ($iRes) {
                return redirect('/admin/service/'.trim($request->input('name')));
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
        $oService = Service::getServiceById($iId);
        if (is_null($oService) || $iId != $id) {
            return json_encode(['code' => 1004, 'msg' => '此服务不存在或已删除']);
        } else {
            Service::destroy($iId);
            return json_encode(['code' => 1001, 'msg' => '删除成功']);
        }
    }

    /**
     * 上传文件并保存到数据库
     */
    public function insertExcelData(Request $request)
    {
        $sFileId = $request->input('file_id');
        $oFile = $request->file($sFileId);
        $iMaxSize = 3;
        if (is_null($oFile)) {
            die;
        }
        //检验一下上传的文件是否有效
        if ($oFile->isValid()) {
            $sMimeType = $oFile->getMimeType();
            //文件类型
            if (!ends_with($sMimeType, '/vnd.openxmlformats-officedocument.spreadsheetml.sheet')) {
                return json_encode(['code' => '1007', 'msg' => '文件格式错误']);
            }
            //文件大小
            $iFileSize = $oFile->getSize();
            if ($iFileSize > ($iMaxSize * 1024 * 1024)) {
                return json_encode(['code' => '1008', 'msg' => '文件过大,请小于' . $iMaxSize . '兆']);
            }
            //上传文件后缀
            $sExtension = $oFile->getClientOriginalExtension();
            //上传文件路径
            $sPublicPath = public_path();
            $sUploadPath = '/uploadfile/import_service';
            $sFullPath = $sPublicPath . $sUploadPath;
            $this->mkdir_upload($sFullPath);
            $sFileName = $sExtension . date('YmdHis') . '.' . $sExtension;
            //移动文件，返回文件绝对路径
            $sRealFile = $oFile->move($sFullPath, $sFileName);
            //上传成功，返回相对路径
            if (file_exists($sRealFile)) {
                //清空session记录
                session()->forget('invalidFile');
                //将数据转存到数据库
                Excel::load('public' . $sUploadPath . '/' . $sFileName, function ($reader) {
                    $reader = $reader->getSheet(0);//excel第一张sheet
                    $result = $reader->toArray();//Excel内容，中文会乱码。$result[0]是标题行
                    //定义标题行，判断是不是示例文件
                    $aTitle = ['服务编号','服务名称','类型(1短2长)','价位/元','服务时长/分','信誉值/个','简介'];
                    if(count(array_diff($result[0],$aTitle)) == 0){
                        for ($i = 1; $i < count($result); $i++){
                            if(in_array(null, $result[$i])){
                                session()->put('invalidFile', json_encode(['code' => '1010', 'msg' => '文件中存在空数据,请核查']));
                            }
                        }
                        if(is_null(session()->get('invalidFile'))){
                            for ($i = 1; $i < count($result); $i++){
                                $oService = Service::getServiceByNum($result[$i][0]);
                                $aData = array(
                                    'number'=>$result[$i][0],
                                    'name'=>$result[$i][1],
                                    'type'=>$result[$i][2],
                                    'price'=>$result[$i][3],
                                    'continue_to'=>$result[$i][4],
                                    'reputation_val'=>$result[$i][5],
                                    'introduction'=>$result[$i][6]
                                );
                                if(is_null($oService)){
                                    //插入
                                    Service::saveService($aData);
                                }else{
                                    //更新
                                    Service::updateService($oService->id, $aData);
                                }
                            }
                        }

                    }else{
                        session()->put('invalidFile', json_encode(['code' => '1006', 'msg' => '请使用标准模板文件上传']));
                    }
                });
                if(session()->get('invalidFile')){
                    return session()->get('invalidFile');
                }else{
                    return json_encode(['code' => '1001', 'msg' => $oFile->getClientOriginalName()]);
                }
            } else {
                return json_encode(['code' => '1009', 'msg' => '文件保存失败']);
            }
        } else {
            return json_encode(['code' => '1006', 'msg' => '该文件无效']);
        }
    }

    //创建文件夹
    public function mkdir_upload($sPath, $sMode = 0775)
    {
        if (!file_exists($sPath)) {
            $this->mkdir_upload(dirname($sPath), $sMode);
            mkdir($sPath, $sMode);
        }
    }
}
