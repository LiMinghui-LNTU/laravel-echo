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
Echo.private('privatePush.' + window.id)
    .listen('PrivateMessageEvent', (e) => {
        alert(e.message);
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
    });
