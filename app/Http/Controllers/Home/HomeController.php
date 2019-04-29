<?php
/**
 * Created by PhpStorm.
 * User: 22971
 * Date: 2018/12/26
 * Time: 11:27
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Model\Knowledge;
use App\Model\Members;
use App\Model\MsgCode;
use App\Model\Recruit;
use App\Model\Resume;
use App\Model\Sowmap;
use App\Model\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        //获取轮播图
        $oSowmaps = Sowmap::getSowmap();
        //获取养护文章
        $oArticles = Knowledge::getSomeArticle(1, 8);
        //获取优惠活动
        $oTicket1 = Ticket::getTicketById(1);
        $oTicket2 = Ticket::getTicketById(2);
        return view($this->sViewPath . 'index', compact('sTitle', 'oSowmaps', 'oArticles', 'oTicket1', 'oTicket2'));
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
        //此方法用于顾客修改昵称或密码
        $nickname = trim($request->input('newNickname'));
        $password = trim($request->input('newPassword'));
        //修改昵称
        $iMemberId = (int)Members::getIdByAccount(session()->get('member')[0])[0];
        if($nickname == '' && $password == ''){
            return json_encode(['code'=>'1010', 'msg'=>'空数据']);
        }elseif ($password == ''){
            $res = Members::changeInfo($iMemberId, 'nickname', $nickname);
            if($res){
                return json_encode(['code'=>'1001', 'msg'=>'修改成功']);
            }
        }else{
            $aPassword = $request->input('value');
            $oldPassword = trim($aPassword[0]);
            $newPassword = trim($aPassword[1]);
            $confirmPassword = trim($aPassword[2]);
            if($oldPassword == '' || $newPassword == ''){
                return json_encode(['code'=>'1010', 'msg'=>'密码不能为空']);
            }elseif ($newPassword != $confirmPassword || $newPassword != $password){
                return json_encode(['code'=>'1013', 'msg'=>'两次密码不一致']);
            }elseif(!Hash::check($oldPassword, Members::getPasswordById($iMemberId))){
                return json_encode(['code'=>'1013', 'msg'=>'原密码错误']);
            }else{
                Members::changeInfo($iMemberId, 'password', Hash::make($newPassword));
                return json_encode(['code'=>'1001', 'msg'=>'密码修改成功']);
            }
        }
        return json_encode(['code'=>'1004', 'msg'=>'数据入库失败']);
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
        if($sModule == 'self'){
            $oFile = $request->file('photo');
        }else{
            $oFile = $request->file($sFileId);
        }
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
                }else{
                    //修改头像
                    $iMemberId = (int)Members::getIdByAccount(session()->get('member')[0])[0];
                    Members::changeInfo($iMemberId, 'photo', $sUploadPath . '/' . $sFileName);
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

    //调用聚合数据接口发送验证码
    public function sendValidateCode(Request $request)
    {
        $phone = trim($request->input('phone_number'));
        $preg_phone = '/^1[3|4|5|6|7|8][0-9]{9}$/';
        if(preg_match($preg_phone, $phone)){
            //生成验证码
            $sCode = MsgCode::generateCode(6);
            //构建参数，调用接口
            $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL
            $smsConf = array(
                'key'   => env('TPL_APP_KEY'), //您申请的APPKEY
                'mobile'    => $phone, //接受短信的用户手机号码
                'tpl_id'    => env('TPL_ID'), //您申请的短信模板ID，根据实际情况修改
                'tpl_value' =>'#code#=' . $sCode //您设置的模板变量，根据实际情况修改
            );

            $content = MsgCode::juHeCurl($sendUrl,$smsConf,1); //请求发送短信

            if($content){
                $result = json_decode($content,true);
                $error_code = $result['error_code'];
                $reason = $result['reason'];
                if($error_code == 0){
                    //状态为0，说明短信发送成功，入库
                    MsgCode::addMsg($result['result']['sid'], $phone, $sCode);
                    return json_encode(['code'=>1001, 'msg'=>$reason]);
                }else{
                    //状态非0，说明失败
                    return json_encode(['code'=>$error_code, 'msg'=>$reason]);
                }
            }else{
                //返回内容异常，以下可根据业务逻辑自行修改
                return json_encode(['code'=>1016, 'msg'=>'接口请求失败']);
            }
        }else{
            return json_encode(['code'=>1013, 'msg'=>'无效号码']);
        }
    }

    //获取验证码
    public function checkValidateCode(Request $request)
    {
        $phone = trim($request->input('phone_number'));
        $preg_phone = '/^1[3|4|5|6|7|8][0-9]{9}$/';
        if(preg_match($preg_phone, $phone)){
            $oCode = MsgCode::getCodeByPhoneNumber($phone);
            if(is_null($oCode)){
                return json_encode(['code'=>1010, 'msg'=>'验证码错误']);
            }else{
                if((int)time() - (int)strtotime($oCode->created_at) > 3 * 60){ //设置验证码过期时间为3分钟
                    return json_encode(['code'=>1017, 'msg'=>'验证码已过期']);
                }else{
                    return json_encode(['code'=>1001, 'msg'=>$oCode->code]);
                }
            }
        }else{
            return json_encode(['code'=>1013, 'msg'=>'无效号码']);
        }
    }
}