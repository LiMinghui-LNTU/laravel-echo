//---------------通用方法区--------------
//手机正则验证
function reg_mobile(mobile) {
    if (!/^1[3|4|5|6|7|8][0-9]{9}$/.test(mobile)) {
        return false;
    } else {
        return true;
    }
}

//邮箱正则验证
function reg_email(email) {
    if(!/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/.test(email)){
        return false;
    }else{
        return true;
    }
}

//自定义弹窗
function tip(message) {
    swal({
        html: '<span style="color: #fff;font-size: 20px;">' + message + '</span>',
        width: 200,
        height: 100,
        background: '#000',
        showConfirmButton: false,
        timer: 1000
    });
}
//--------------end----------------------------

//------------前台注册方法区--------------------------
//请求手机短信验证码
$("#sendMobileCode").click(function () { //保存到库
    var phone = $("#phone_number").val();
    if(phone == ''){
        tip("请填写手机号");
        return false;
    }
    if (!reg_mobile(phone)) {
        tip("该手机号有误");
        return false;
    }
    $("#sendMobileCode").attr("disabled", true);
    settime();
});

var countdown = 60;
var _generate_code = $("#dyMobileButton");

function settime() {
    if (countdown == 0) {
        $("#sendMobileCode").attr("disabled", false);
        _generate_code.text("获取");
        countdown = 60;
        return false;
    } else {
        $("#sendMobileCode").attr("disabled", true);
        $("#dyMobileButton").text(countdown + "秒");
        countdown--;
    }
    setTimeout(function () {
        settime();
    }, 1000);
}

<!--登录或注册切换-->
function doReg(){
    $(".login-banner").hide();
    $(".res-banner").show();
}
<!--切换注册方式-->
$(function () {
    $('#doc-my-tabs').tabs();
});

//邮箱注册
$("#reg-email-btn").click(function () {
    var email = $("#account-email").val();
    var password = $("#password-email").val();
    var repassword = $("#re-password-email").val();
    if(email == ''){
        tip("请填写邮箱");
        return false;
    }
    if(!reg_email(email)){
        tip("该邮箱有误");
        return false;
    }
    if(password.length < 6){
        tip("密码至少6位");
        return false;
    }
    if(repassword != password){
        tip("两次密码不一致");
        return false;
    }
    $("#email-reg").submit();
});

//手机号注册
$("#reg-phone-btn").click(function () {
    //查询刚刚发送的手机号及验证码
    var p = '13582853262';
    var c = '123456';
    var phone = $("#phone_number").val();
    var check_code = $("#check_code").val();
    var password = $("#password-phone").val();
    var repassword = $("#re-password-phone").val();
    if(phone == ''){
        tip("请填写手机号");
        return false;
    }
    if (!reg_mobile(phone)) { //可在此验证与发送验证码时的手机号是否一致
        tip("该手机号有误");
        return false;
    }
    if(check_code == ''){
        tip("请填写验证码");
        return false;
    }
    if(check_code != c){ //可在此验证发送的验证码
        tip("验证码错误");
        return false;
    }
    if(password.length < 6){
        tip("密码至少6位");
        return false;
    }
    if(repassword != password){
        tip("两次密码不一致");
        return false;
    }
    $("#phone-reg").submit();
});