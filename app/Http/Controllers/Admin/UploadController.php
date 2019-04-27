<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2019/2/17
 * Time: 14:42
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    private $iMaxSize = 6;

    //文件上传
    public function uploadFile(Request $request)
    {
        $sFileId = $request->input('file_id');
        $oFile = $request->file($sFileId);
        //检验一下上传的文件是否有效
        if ($oFile->isValid()) {
            $sMimeType = $oFile->getMimeType();
            //文件类型
            if (!$this->is_image($sMimeType)) {
                return json_encode(['code' => '1007', 'msg' => '图片格式错误']);
            }
            //文件大小
            $iFileSize = $oFile->getSize();
            if ($iFileSize > ($this->iMaxSize * 1024 * 1024)) {
                return json_encode(['code' => '1008', 'msg' => '图片过大,请小于' . $this->iMaxSize . '兆']);
            }
            //上传文件后缀
            $sExtension = $oFile->getClientOriginalExtension();
            //上传文件路径
            $sPublicPath = public_path();
            $sUploadPath = $sFileId == 'user-head-img' ? '/uploadfile/user_photo' : '/uploadfile/designer_photo';
            $sFullPath = $sPublicPath . $sUploadPath;
            $this->mkdir_upload($sFullPath);
            $sFileName = $sExtension . date('YmdHis') . '.' . $sExtension;
            //移动文件，返回文件绝对路径
            $sRealFile = $oFile->move($sFullPath, $sFileName);
            //上传成功，返回相对路径
            if (file_exists($sRealFile)) {
                if($sFileId == 'user-head-img'){
                    //更新用户头像
                    User::updateUserInfo(Auth::User()->id, 'head_url', $sUploadPath . '/' . $sFileName);
                }
                return json_encode(['code' => '1001', 'msg' => $sUploadPath . '/' . $sFileName]);
            } else {
                return json_encode(['code' => '1009', 'msg' => '图片保存失败']);
            }
        } else {
            return json_encode(['code' => '1006', 'msg' => '该图片无效']);
        }
    }

    /**
     * 判断文件的MIME类型是否为图片
     */
    private function is_image($mimeType)
    {
        return starts_with($mimeType, 'image/');
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