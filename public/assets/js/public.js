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
    if (!/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/.test(email)) {
        return false;
    } else {
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

//支付弹框
function pay(message, number, title, designer, money, ticket) {

}

//等待弹窗
function wait(message) {
    swal({
        html: '<i class="am-icon-spinner am-icon-pulse am-icon-md"></i>&nbsp;<span style="color: #fff;font-size: 18px;">' + message + '</span>',
        width: 150,
        height: 60,
        background: '#000',
        showConfirmButton: false,
    });
}

//--------------end----------------------------

//------------前台注册方法区--------------------------
//请求手机短信验证码
$("#sendMobileCode").click(function () {
    var phone = $("#phone_number").val();
    if (phone == '') {
        tip("请填写手机号");
        return false;
    }
    if (!reg_mobile(phone)) {
        tip("该手机号有误");
        return false;
    }
    //发送验证码并保存


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
function doReg() {
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
    if (email == '') {
        tip("请填写邮箱");
        return false;
    }
    if (!reg_email(email)) {
        tip("该邮箱有误");
        return false;
    }
    if (password.length < 6) {
        tip("密码至少6位");
        return false;
    }
    if (repassword != password) {
        tip("两次密码不一致");
        return false;
    }
    $.post(
        'check-reg',
        {
            _token: $("input[name='_token']").val(),
            account: email
        },
        function (data) {
            if (data == '1') {
                tip("该邮箱已注册");
                return false;
            } else {
                wait("请稍后...");
                $("#reg-email-btn").attr('disabled', true);
                $.post(
                    '/reg',
                    {
                        _token: $("input[name='_token']").val(),
                        'reg-type': 1,
                        'account-email': email,
                        'password-email': password
                    },
                    function (data) {
                        if (data.success) {
                            tip("注册成功");
                            window.location.reload();
                        } else {
                            tip("注册失败");
                            return false;
                        }
                    },
                    'json'
                );
            }
        }
    );

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
    if (phone == '') {
        tip("请填写手机号");
        return false;
    }
    if (!reg_mobile(phone)) { //可在此验证与发送验证码时的手机号是否一致
        tip("该手机号有误");
        return false;
    }
    if (check_code == '') {
        tip("请填写验证码");
        return false;
    }
    if (check_code != c) { //可在此验证发送的验证码
        tip("验证码错误");
        return false;
    }
    if (password.length < 6) {
        tip("密码至少6位");
        return false;
    }
    if (repassword != password) {
        tip("两次密码不一致");
        return false;
    }
    $.post(
        'check-reg',
        {
            _token: $("input[name='_token']").val(),
            account: phone
        },
        function (data) {
            if (data == '1') {
                tip("该手机号已注册");
                return false;
            } else {
                wait("请稍后...");
                $("#reg-phone-btn").attr('disabled', true);
                $.post(
                    '/reg',
                    {
                        _token: $("input[name='_token']").val(),
                        'reg-type': 2,
                        phone_number: phone,
                        password_phone: password
                    },
                    function (data) {
                        if (data.success) {
                            tip("注册成功");
                            window.location.reload();
                        } else {
                            tip("注册失败");
                            return false;
                        }
                    },
                    'json'
                );
            }
        }
    );
});
//-------end-----------------

//--------------前台登录方法---------------
function doLogin() {
    var account = $("#account").val();
    var password = $("#password").val();
    if (account == '') {
        tip("请输入账号");
        return false;
    }
    if (password == '') {
        tip("请输入密码");
        return false;
    }
    wait("正在登录...");
    $.post(
        '/login',
        {
            _token: $("input[name='_token']").val(),
            account: account,
            password: password
        },
        function (data) {
            if (data.success) {
                window.location.href = '/self';
            } else {
                if (data.code == '1002') {
                    tip("用户名或密码错误");
                    return false;
                }
                if (data.code == '1003') {
                    tip("该账号未激活");
                    return false;
                }
            }
        },
        'json'
    );
}

//-------------end-------------------

//-----------留言-------------
function leaveWords(id) {
    $("#area").slideDown();
    $(".am-comments-list").slideUp();
    if ($("#comment-area").val() == '') {
        $("#comment-area").val("请留下您的宝贵意见...");
        return false;
    } else {
        $.get(
            'self/' + id,
            {
                message_from: id,
                message_to: '2',
                message_content: $("#comment-area").val(),
                type: '2'
            },
            function (data) {
                if (data.code == '1001') {
                    $("#comment-area").val("");
                    $("#message-content").append(data.msg);
                } else {
                    tip(data.msg);
                    return false;
                }
            },
            'json'
        );
    }
}

function messages() {
    $("#comment-area").val("");
    $("#area").slideUp();
    $(".am-comments-list").slideDown();
}

//----------end--------------------

//--------我的订单-------------
function showOrder(index, number, time, reputation, intro) {
    $("#number" + index).html(number); //显示单号
    $("#time" + index).html(time + "分钟"); //显示时间
    $("#reputation" + index).html(reputation); //显示信誉值
    $("#introduction" + index).html(intro); //显示简介
    $("input[name='order" + index + "']").val(number); //设置单号
    // var status = $("input[name='order" + index + "']").prop('checked');
}

//短发/长发价位切换
function changePrice(type) {
    $("input[type='checkbox']").attr("checked", false);
    $("input[type='checkbox']").val("on");
    $("input[name!='type']").attr("checked", false);
    $("input[name!='type']").attr("disabled", false);
    $("tr").attr("style", "");
    $("#service-price").html(0);
    $("#service-time").html(0);
    $("#service-reputation").html(0);
    if (type == '1') { //显示短发价位
        $("#short-hair").show();
        $("#long-hair").hide();
    } else {
        $("#short-hair").hide();
        $("#long-hair").show();
    }
}

//检验订单选择状态
function checkPrice(obj, index) {
    if (obj.value == 'on') {
        obj.checked = false;
        tip("请选择价位");
        return false;
    }
    //清空日程选择表
    if ($("#start-time").val() != '' || $("#end-time").val() != '') {
        $('#calendar').fullCalendar('unselect');
        $("#start-time").val("");
        $("#end-time").val("");
    }
    //动态增加或减少预定时间
    if (obj.checked) {
        $("#tr" + index).attr("style", "color:#f00");
        $("input[name='charge" + index + "']").attr("disabled", true);
        $.post(
            '/get-service',
            {'_token': $("#_token").val(), 'service_num': obj.value},
            function (data) {
                var old_price = $("#service-price").html();
                var old_time = $("#service-time").html();
                var old_reputation = $("#service-reputation").html();
                $("#service-price").html(parseInt(old_price) + data.price);
                $("#service-time").html(parseInt(old_time) + parseInt(data.time));
                $("#service-reputation").html(parseInt(old_reputation) + parseInt(data.reputation));
            },
            'json'
        );
    } else {
        $("#tr" + index).attr("style", "");
        $("input[name='charge" + index + "']").attr("disabled", false);
        $.post(
            '/get-service',
            {'_token': $("#_token").val(), 'service_num': obj.value},
            function (data) {
                var old_price = $("#service-price").html();
                var old_time = $("#service-time").html();
                var old_reputation = $("#service-reputation").html();
                $("#service-price").html(parseInt(old_price) - data.price);
                $("#service-time").html(parseInt(old_time) - parseInt(data.time));
                $("#service-reputation").html(parseInt(old_reputation) - parseInt(data.reputation));
            },
            'json'
        );
    }
}

//提交预定
function doReservation() {
    var total_money = $("#service-price").text();//订单总价
    var designer_id = $("#designer-id").val();//造型师id
    var start_time = $("#start-time").val();//日程开始时间
    var end_time = $("#end-time").val();//日程结束时间
    if (total_money == '0') {
        tip("请选择服务项目");
        return false;
    }
    if (designer_id == '') {
        tip("请翻牌造型师");
        return false;
    }
    if (start_time == '' || end_time == '') {
        tip("请勾选预定时间");
        return false;
    }
    var length = $("input[type='checkbox']").length;
    var service_arr = [];
    for (var i = 0; i < length; i++) {
        if ($("input[name='order" + i + "']").prop('checked')) {
            service_arr.push($("input[name='order" + i + "']").val());
        }
    }
    wait("预定中...");
    $.post(
        '/self',
        {
            '_token': $("#_token").val(),
            'service_number': service_arr,
            'designer_id': designer_id,
            'total_money': total_money,
            'start': $("#start-time").val(),
            'end': $("#end-time").val()
        },
        function (data) {
            if (data.success) {
                tip("预订成功");
                window.location.href = '/self';
            } else {
                tip(data.code + ":预定失败");
                return false;
            }
        },
        'json'
    );
}