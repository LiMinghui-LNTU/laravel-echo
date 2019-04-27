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
    //播放音效
    $("#play-order-tip").click();
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
    //播放音效
    $("#play-message-tip").click();
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

//造型师改变订单状态
function changeOrderStatus(orderId, option) {
    swal({
        html: '<i class="am-icon-spinner am-icon-pulse am-icon-md"></i>&nbsp;<span style="color: #fff;font-size: 18px;">正在执行操作，请稍后...</span>',
        width: 300,
        height: 60,
        background: '#000',
        showConfirmButton: false,
    });
    $.post(
        '/admin/change-order-status',
        {
            _token: $("input[name='_token']").val(),
            orderId: orderId,
            option: option
        },
        function (data) {
            if(data.code == '1001'){
                window.location.reload();
            }else {
                tip(data.msg);
                return false;
            }
        },
        'json'
    );
}

//后台编辑个人信息
$(function () {
    //点击编辑用户名图标
    $(".username-icon-edit").click(function () {
        $(".username-icon-edit").hide();
        var username = $(".username-icon-edit").prev("span").html().trim();
        $(".username-input").html("<input class='username-panel' type='text' style='width: 55px; height: 16px;' placeholder='"+username+"'>");
        $(".username-panel").focus();
        $(".username-icon-check").show();
        $(".username-icon-close").show();
    });
    //点击取消编辑用户名图标
    $(".username-icon-close").click(function () {
        $(".username-icon-check").hide();
        $(".username-icon-close").hide();
        var username = $(".username-panel").attr("placeholder");
        $(".username-input").html(username);
        $(".username-icon-edit").show();
    });
    //点击确认提交用户名图标
    $(".username-icon-check").click(function () {
        var oldUsername = $(".username-panel").attr("placeholder").trim();
        var username = $(".username-panel").val().trim();
        if(oldUsername == username){
            $(".username-icon-close").click();
            return false;
        }
        if(username == '' || username.length > 6){
            showMessage("请限制在6字符以内");
            $(".username-panel").focus();
            return false;
        }else {
            $(".username-icon-check").hide();
            $(".username-icon-close").hide();
            showMessage("正在提交...");
            $.post(
                '/admin/edit-info',
                {
                    _token: $("input[name='_token']").val(),
                    column: 'username',
                    newUsername: username
                },
                function (data) {
                    if(data.code == '1001'){
                        $(".username-input").html(username);
                        $(".username-icon-edit").show();
                        showMessage("修改成功");
                        return false;
                    }else {
                        $(".username-icon-close").click();
                        showMessage(data.msg);
                        return false;
                    }
                },
                'json'
            );
        }
    });
    //点击修改密码图标
    $(".password-icon-edit").click(function () {
        Swal.mixin({
            allowOutsideClick :false,
            input: 'password',
            confirmButtonText: '下一步',
            showCancelButton: true,
            progressSteps: ['1', '2', '3']
        }).queue([
            {
                title: '原密码',
                text: '请输入原密码'
            },
            '新密码',
            '确认密码'
        ]).then((result) => {
            if(result.value == null){return false;}
            if(result.value[0].trim() == '' || result.value[1].trim() == ''){
                showMessage("密码不能为空");
                return false;
            }else if(result.value[1].trim() != result.value[2].trim()){
                showMessage("两次密码不一致");
                return false;
            }else {
                $.post(
                    '/admin/edit-info',
                    {
                        _token: $("input[name='_token']").val(),
                        column: 'password',
                        newPassword: result.value[1].trim(),
                        oldPassword: result.value[0].trim(),
                        confirmPassword: result.value[2].trim()
                    },
                    function (data) {
                        if(data.code == '1001'){
                            Swal.fire({
                                title: '修改成功',
                                html: '您的密码已修改，请重新登录平台',
                                confirmButtonText: '好的',
                                allowOutsideClick :false
                            }).then((result)=>{
                                if(result.value){
                                    window.location.href = '/admin/logout';
                                }
                            });
                        }else {
                            showMessage(data.msg);
                            return false;
                        }
                    },
                    'json'
                );
            }
        });
    });

    //更换头像
    //实例化一个plupload上传对象
    var uploader = new plupload.Uploader({
        browse_button : "user-head-img", //触发文件选择对话框的按钮，为那个元素id
        url : '/admin/upload-photo', //服务器端的上传页面地址
        filters : {
            mime_types : [ //只允许上传图片和zip文件
                { title : "Image files", extensions : "jpg,gif,png" }
            ],
            max_file_size : '400kb', //最大只能上传400kb的文件
            prevent_duplicates : true //不允许选取重复文件
        },
        multipart_params: {
            _token:$("input[name='_token']").val(),
            file_id:'user-head-img'
        },
        multi_selection : false,//设置是否可多选
        file_data_name: 'user-head-img',//	指定文件上传时文件域的名称

        flash_swf_url : "{{asset('assets/js/plupload/Moxie.swf')}}", //swf文件，当需要使用swf方式进行上传时需要配置该参数
        silverlight_xap_url : "{{asset('assets/js/plupload/Moxie.xap')}}" //silverlight文件，当需要使用silverlight方式进行上传时需要配置该参数
    });

    //在实例对象上调用init()方法进行初始化
    uploader.init();

    //绑定各种事件，并在事件监听函数中做你想做的事
    uploader.bind('FilesAdded',function(uploader,files){
        for(var i = 0, len = files.length; i<len; i++){
            // var file_name = files[i].name; //文件名
            // //构造html来更新UI
            // var html = '<li id="file-' + files[i].id +'"><p class="file-name">' + file_name + '</p><p class="progress"></p></li>';
            // $(html).appendTo('#file-list');
            //预览图片
            !function(i){
                previewImage(files[i],function(imgsrc){
                    $('.user-head-img').attr('src', imgsrc);
                })
            }(i);
        }
        $(".photo-upload").show();
    });
    $(".photo-upload").click(function () {
        $(".photo-upload").hide();
        uploader.start();
    });
    uploader.bind('UploadProgress',function(uploader,file){
        //每个事件监听函数都会传入一些很有用的参数，
        //我们可以利用这些参数提供的信息来做比如更新UI，提示上传进度等操作
        showMessage("正在上传...");
    });
    uploader.bind('FileUploaded',function (uploader,file,responseObject) {
        if(responseObject.status == 200){
            showMessage("上传成功");
        }
    });
    uploader.bind('Error',function (uploader, errObject) {
        showMessage("上传出错了");
        return false;
    });

    //预览图片
    function previewImage(file,callback){//file为plupload事件监听函数参数中的file对象,callback为预览图片准备完成的回调函数
        if(!file || !/image\//.test(file.type)) return; //确保文件是图片
        if(file.type=='image/gif'){//gif使用FileReader进行预览,因为mOxie.Image只支持jpg和png
            var fr = new mOxie.FileReader();
            fr.onload = function(){
                callback(fr.result);
                fr.destroy();
                fr = null;
            }
            fr.readAsDataURL(file.getSource());
        }else{
            var preloader = new mOxie.Image();
            preloader.onload = function() {
                preloader.downsize( 200, 200 );//先压缩一下要预览的图片,宽300，高300
                var imgsrc = preloader.type=='image/jpeg' ? preloader.getAsDataURL('image/jpeg',80) : preloader.getAsDataURL(); //得到图片src,实质为一个base64编码的数据
                callback && callback(imgsrc); //callback传入的参数为预览图片的url
                preloader.destroy();
                preloader = null;
            };
            preloader.load( file.getSource() );
        }
    }
});
