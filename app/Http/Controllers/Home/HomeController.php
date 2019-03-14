<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2018/12/26
 * Time: 11:27
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Model\Recruit;
use App\Model\Resume;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $sViewPath = 'home.home.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sTitle = '金鹰首页';
        return view($this->sViewPath . 'index', compact('sTitle'));
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

    //文件上传
    public function uploadFile(Request $request)
    {
        $sFileId = $request->input('file_id');
        $sModule = $request->input('module');
        $oFile = $request->file($sFileId);
        $iMaxSize = $sModule == 'self' ? 6 : 1;
        if (is_null($oFile)) {
            die;
        }
        //检验一下上传的文件是否有效
        if ($oFile->isValid()) {
            $sMimeType = $oFile->getMimeType();
            //文件类型
            if ($sModule == 'self' && !$this->is_image($sMimeType)) {
                return json_encode(['code' => '1007', 'msg' => '图片格式错误']);
            }
            if ($sModule == 'recruit' && !$this->is_pdf($sMimeType)) {
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
            $sUploadPath = $sModule == 'self' ? '/uploadfile/member_head' : '/uploadfile/resume';
            $sFullPath = $sPublicPath . $sUploadPath;
            $this->mkdir_upload($sFullPath);
            $sFileName = $sExtension . date('YmdHis') . '.' . $sExtension;
            //移动文件，返回文件绝对路径
            $sRealFile = $oFile->move($sFullPath, $sFileName);
            //上传成功，返回相对路径
            if (file_exists($sRealFile)) {
                if ($sModule == 'recruit') {
                    //简历入库
                    $iInfoId = (int)substr($sFileId, 6);
                    Recruit::updateCount($iInfoId, 1);
                    $data = array(
                        'recruit_id' => $iInfoId,
                        'name' => $oFile->getClientOriginalName(),
                        'url' => $sUploadPath . '/' . $sFileName,
                        'ip' => Recruit::getIp()
                    );
                    Resume::saveResume($data);
                }
                return json_encode(['code' => '1001', 'msg' => $sUploadPath . '/' . $sFileName]);
            } else {
                return json_encode(['code' => '1009', 'msg' => '文件保存失败']);
            }
        } else {
            return json_encode(['code' => '1006', 'msg' => '该文件无效']);
        }
    }

    /**
     * 判断文件的MIME类型是否为图片
     */
    private function is_image($mimeType)
    {
        return starts_with($mimeType, 'image/');
    }

    public function is_pdf($mimeType)
    {
        return ends_with($mimeType, '/pdf');
    }

    /**
     * 创建文件夹
     */
    public function mkdir_upload($sPath, $sMode = 0775)
    {
        if (!file_exists($sPath)) {
            $this->mkdir_upload(dirname($sPath), $sMode);
            mkdir($sPath, $sMode);
        }
    }
}