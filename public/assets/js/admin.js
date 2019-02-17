//---------获取消息------------
function getMessage(id) {
    $("#people-list").slideUp();
    $("#paginate-nav").slideUp();
    $("#reply-panel").slideDown();
}

function goBack() {
    $("#reply-panel").slideUp();
    $("#paginate-nav").slideDown();
    $("#people-list").slideDown();
}

//上传URL,文件域的id，显示图片的id,隐藏的id
function uploadThumb(url, file_id, show_id, hide_id){
    $.ajaxFileUpload({
        url:url,//用于文件上传的服务器端请求地址
        secureuri:false,//是否需要安全协议，一般设置为false
        fileElementId: file_id,//文件上传域的id  <input type="file" id="file" name="file" />
        data:{
            '_token': $('input[name=_token]').val(),
            'file_id': file_id ,
        },
        dataType: 'json',//返回数据类型:text，xml，json，html,scritp,jsonp五种
        type:'post',
        success: function (result)  //服务器成功响应处理函数
        {
            if (result.code == '1001') {
                if (show_id) {
                    $("#"+show_id).show();
                    $("#"+show_id).attr('src', result.msg);
                }
                $("#"+hide_id).val(result.msg);
            } else {
                swal(result.msg);
            }
        }
    })
}