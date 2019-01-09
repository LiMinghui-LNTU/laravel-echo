//手机正则验证
function reg_mobile(mobile) {
    if (!/^1[3|4|5|6|7|8][0-9]{9}$/.test(mobile)) {
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