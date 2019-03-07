/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


Echo.channel('public.' + window.localStorage.getItem('member_id'))
    .listen('PublicMessageEvent', (e) => {
        var num = $("#msg-num").html();
        var new_num = num == '' ? 1 : parseInt(num) + 1;
        $("#msg-num").html(new_num);
        $.post(
            '/from-shopowner',
            {
                _token: $("input[name='_token']").val(),
                id: e.message.id
            },
            function (data) {
                if (data.code == '1001') {
                    $("#message-content").append(data.msg);
                    messageTip(e.message.pre_type);
                } else {
                    tip(data.msg);
                    return false;
                }
            },
            'json'
        );
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
        orderTip(e.order.order_number);
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
        // console.log(window.localStorage.getItem('to') + "#" + window.localStorage.getItem('type'));
        // console.log(e.message);
        if (e.message.pre_type == 2) { //发送者为店长，店长可将消息发送给店员、顾客和管理员(发给顾客走公有频道，再次不做处理)
            if (e.message.type == 3) { //发给店员

            } else { //发给管理员

            }
        } else { //发送者为顾客或店员或管理员，这些角色只能将消息发送给店长
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
                            $("#message-list").html(data.msg_list);
                        } else {
                            $("#message-list").prepend(data.msg_tr);
                        }
                        messageTip(e.message.pre_type);
                    } else {
                        showMessage(data.msg);
                        return false;
                    }
                },
                'json'
            );
        }
    });
