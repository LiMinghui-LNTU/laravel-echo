//---------获取消息------------
function getMessage(from, pre_type) {
    $.post(
        '/admin/get-message',
        {
            _token: $("input[name='_token']").val(),
            from: from,
            pre_type: pre_type
        },
        function (data) {
            if (data.code == '1001') {
                $("#hide-from").val(from);
                $("#hide-pre_type").val(pre_type);
                $("#ul-message").html(data.msg);
                $("#people-list").slideUp();
                $("#paginate-nav").slideUp();
                $("#reply-panel").slideDown();
                var num = $("#" + from + "-msg-" + pre_type).html();
                if (num != '') {
                    var total = parseInt($("#msg-num").html());
                    num = parseInt(num);
                    $("#msg-num").html(total - num);
                    $("#" + from + "-msg-" + pre_type).html("");
                }
            } else {
                showMessage(data.msg);
                return false;
            }
        },
        'json'
    );
}

function goBack() {
    $("#reply-content").val("");
    $("#reply-panel").slideUp();
    $("#paginate-nav").slideDown();
    $("#people-list").slideDown();
    $.post(
        '/admin/message',
        {
            _token: $("input[name='_token']").val()
        },
        function (data) {
            if (data.msg == 0) {
                $("#msg-num").html("");
            } else {
                $("#msg-num").html(data.msg);
            }
        },
        'json'
    );
}

//店长回复消息
function reply() {
    //回复消息时，发送方变为接收方
    var to = $("#hide-from").val();
    var type = $("#hide-pre_type").val();
    var content = $("#reply-content").val();
    if (content.trim() == '') {
        $("#reply-content").focus();
        return false;
    } else {
        $.post(
            '/admin/reply-message',
            {
                _token: $("input[name='_token']").val(),
                to: to,
                type: type,
                content: content
            },
            function (data) {
                if (data.code == '1001') {
                    $("#reply-content").val("");
                    $("#ul-message").append(data.msg);
                } else {
                    showMessage(data.msg);
                    return false;
                }
            },
            'json'
        );
    }
}

//切换显示状态
function doSwitch(id, module, obj) {
    var state = $(obj).is(':checked') ? 1 : 0;
    $.get(
        '/admin/' + module + '/' + id,
        {
            state: state
        },
        function (data) {
            if (data.code != '1001') {
                showMessage(data.msg);
                return false;
            }
        },
        'json'
    );
}

//提示消息
function showMessage(message) {
    swal({
        html: '<span style="color: #444;font-size: 20px;">' + message + '</span>',
        width: 500,
        height: 300,
        background: '#ddd',
        showConfirmButton: false,
        timer: 1500
    });
}

//新订单提示
function orderTip(order_number) {
    Swal.fire({
        position: 'top-end',
        html: '<span style="color: #ff0;font-size: 20px;">您有一条新订单：' + order_number + '</span>',
        width: 500,
        height: 300,
        background: '#a00',
        showConfirmButton: false,
        timer: 1500
    });
}

//新消息提示
function messageTip(pre_type) {
    var from = '未知';
    switch (pre_type) {
        case 1 :
            from = '管理员';
            break;
        case 2 :
            from = '店长';
            break;
        case 3 :
            from = '店员';
            break;
        case 4 :
            from = '顾客';
            break;
    }
    Swal.fire({
        position: 'top-end',
        html: '<span style="color: #fff;font-size: 20px;">您有一条' + '<span style="color: red;font-weight: bold;">' + from + '</span>' + '消息！</span>',
        width: 400,
        height: 250,
        background: '#00f',
        showConfirmButton: false,
        timer: 2000
    });
}

//后台做删除
function doDestroy(id, module) {
    Swal.fire({
        title: '确认删除吗？',
        // text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#abc',
        confirmButtonText: '确认',
        cancelButtonText: '取消'
    }).then((result) => {
        if (result.value) {
            $.post(
                '/admin/' + module + '/' + id,
                {
                    _token: $("input[name='_token']").val(),
                    _method: "DELETE",
                    id: id
                },
                function (data) {
                    if (data.code == '1001') {
                        if(module == 'resume'){
                            window.location.reload();
                        }else {
                            window.location.href = '/admin/' + module;
                        }
                    } else {
                        showMessage(data.code + data.msg);
                        return false;
                    }
                },
                'json'
            );
        }
    });
}

//上传URL,文件域的id，显示图片的id,隐藏的id
function uploadThumb(url, file_id, show_id, hide_id) {
    if(show_id == ''){
        showMessage("文件上传中...");
    }
    $.ajaxFileUpload({
        url: url,//用于文件上传的服务器端请求地址
        secureuri: false,//是否需要安全协议，一般设置为false
        fileElementId: file_id,//文件上传域的id  <input type="file" id="file" name="file" />
        data: {
            '_token': $("input[name='_token']").val(),
            'file_id': file_id,
        },
        dataType: 'json',//返回数据类型:text，xml，json，html,scritp,jsonp五种
        type: 'post',
        success: function (result)  //服务器成功响应处理函数
        {
            if (result.code == '1001') {
                if (show_id) {
                    $("#" + show_id).show();
                    $("#" + show_id).attr('src', result.msg);
                }else {
                    $("#" + hide_id).html(result.msg+"上传成功");
                }
                $("#" + hide_id).val(result.msg);
            } else {
                swal(result.msg);
            }
        }
    })
}

//点击单号表示已读
function iKnow(obj, orderId) {
    $.get(
        '/admin/clerk/' + orderId + '/edit',
        {
            order_id: orderId
        },
        function (data) {
            if (data.code == '1001') {
                var old_num = $("#tip_num").html();
                var now_num = parseInt(old_num) - 1;
                if (parseInt(now_num) > 0) {
                    $("#tip_num").html(now_num);
                } else {
                    $("#tip_num").html("");
                }
                $(obj).attr("style", "");
                $(obj).attr("onclick", "");
                $(obj).html(data.msg);
            } else {
                showMessage(data.msg);
                return false;
            }
        },
        'json'
    );
}