<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MsgCode extends Model
{
    use SoftDeletes;

    protected $table = 'msg_code';

    protected $guarded = ['id', 'deleted_at'];

    /**
     * 生成验证码
     */
    public static function generateCode($length = 0) {
        return rand(pow(10,($length-1)), pow(10,$length)-1);
    }

    /**
     * 短信入库
     */
    public static function addMsg($sId= '', $sPhone = '', $sCode = '')
    {
        return self::insert(['sid'=>$sId, 'phone_number'=>$sPhone, 'code'=>$sCode, 'created_at'=>date('Y-m-d H:i:s')]);
    }

    /**
     * 根据手机号查询对应的验证码
     */
    public static function isValidateCode($sPhone = '', $sCode = '')
    {
        return self::where('phone_number', $sPhone)->where('code', $sCode)->orderBy('created_at', 'desc')->first();
    }

    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    public static function juHeCurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }
}
