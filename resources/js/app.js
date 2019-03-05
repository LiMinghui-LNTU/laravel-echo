/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


Echo.channel('push')
    .listen('.push.message', (e) => {
        $("#content").append(e.message + "<br>");
        console.log(e);
    });

//监听订单创建
Echo.private('order.' + window.localStorage.getItem('designer_id'))
    .listen('OrderCreateEvent', (e) => {
        var num = $("#tip_num").html();
        if (num == '') {
            $("#tip_num").html("1");
        } else {
            $("#tip_num").html(parseInt(num) + 1);
        }
        Swal.fire({
            position: 'top-end',
            html: '<span style="color: #ff0;font-size: 20px;">您有一条新订单：' + e.order.order_number + '</span>',
            width: 500,
            height: 300,
            background: '#a00',
            showConfirmButton: false,
            timer: 1500
        });
        //ajax回显数据
        $.post(
            '/admin/clerk',
            {
                _token: $("input[name='_token']").val()
            },
            function (data) {
                if (data.code == '1001') {
                    $("#order-content").html(data.msg);
                } else {
                    showMessage(data.msg);
                    return false;
                }
            },
            'json'
        );
    });

//监听消息收发
Echo.private('message.' + window.localStorage.getItem('to') + window.localStorage.getItem('type'))
    .listen('MessageEvent', (e) => {
        console.log(window.localStorage.getItem('to') + "#" + window.localStorage.getItem('type'));
        console.log(e.message);
        if (e.message.pre_type == 4) { //发送者为顾客，顾客只能将消息发给店长
            $.post(
                '/to-shopowner',
                {
                    _token: $("input[name='_token']").val(),
                    id: e.message.id,
                    from: e.message.from,
                    pre_type: e.message.pre_type,
                    to: e.message.to,
                    type: e.message.type
                },
                function (data) {
                    if (data.code == '1001') {
                        if ($("#hide-from").val() == e.message.from && $("#hide-pre_type").val() == e.message.pre_type) {
                            $("#ul-message").append(data.msg_content);
                        }
                        if (data.exist) {
                            var num = $("#" + e.message.from + "-num-" + e.message.pre_type).html();
                            if (num == '') {
                                $("#" + e.message.from + "-num-" + e.message.pre_type).html("1");
                            } else {
                                $("#" + e.message.from + "-num-" + e.message.pre_type).html(parseInt(num) + 1);
                            }
                            var content = (e.message.content).length > 50 ? (e.message.content).substring(0, 50) : e.message.content;
                            $("#"+ e.message.from + "-content-" + e.message.pre_type).html(content);
                            $("#"+ e.message.from + "-time-" + e.message.pre_type).html(e.message.created_at);
                        } else {
                            $("#message-list").prepend(data.msg_list);
                        }
                    } else {
                        showMessage(data.msg);
                        return false;
                    }
                },
                'json'
            );
        } else if (e.message.pre_type == 3) { //发送者为店员，店员只能将消息发给店长

        } else if (e.message.pre_type == 2) { //发送者为店长，店长可以将消息发送给店员，也可发送给顾客，还可以发送给管理员
            if (e.message.type == 3) { //发给店员

            } else if (e.message.type == 4) { //发给顾客

            } else { //发给管理员

            }
        } else { //发送者为管理员，管理员只能将消息发送给店长

        }
    });
