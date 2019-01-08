//手机正则验证
function reg_mobile (mobile)
{
    if( ! /^1[3|4|5|6|7|8][0-9]{9}$/.test(mobile)) {
        return false;
    } else {
        return true;
    }
}