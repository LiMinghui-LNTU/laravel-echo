@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
<style>

</style>
@section('content')
    <div class="toppic">
        <div class="am-container-1">
            <div class="toppic-title left">
                <i class="am-icon-user toppic-title-i"></i>
                <span class="toppic-title-span">个人中心</span>
                <p>Center</p>
            </div>
            <div class="right toppic-progress">
                <span><a href="/home" class="w-white">首页</a></span>
                <i class=" am-icon-arrow-circle-right w-white"></i>
                <span><a href="javascript:;" class="w-white">订单确认</a></span>
            </div>
        </div>
    </div>
    @csrf
    <nav class="m-cat-nav">

    </nav>
    <div class="am-container m-contact-page">
        <article class="m-mn-box">
            <h3 style="margin-bottom: 10px;">尊敬的顾客，您的订单详情如下，请核对：</h3>
            <div onmouseover="$('#reselect').show();" onmouseout="$('#reselect').hide();">
                <?php $arr = explode( ',', $service_arr); ?>
                <form action="/pay-order" id="orderForm" method="post">
                    @csrf
                    <input type="hidden" id="service-arr" name="service_number" value="{{$service_arr}}">
                    <input type="hidden" id="designer-id" name="designer_id" value="{{$designer_id}}">
                    <input type="hidden" id="start-time" name="start" value="{{$start_time}}">
                    <input type="hidden" id="end-time" name="end" value="{{$end_time}}">
                    <input type="hidden" id="my-balance" value="{{$oInfo->balance}}">
                    <input type="hidden" id="terminal-money" name="terminal-money">
                    <input type="hidden" id="ticket-id" name="ticket-id">
                </form>
                <button id="reselect" class="am-btn am-btn-sm am-btn-danger" style="float: right;margin: 5px 4px 0 0;display: none;" onclick="window.location.href='/self/create';"><i class="am-icon-reply"></i>返回修改</button>
                <p><i class="am-icon-hand-paper-o"></i> 服务项目：<span>@foreach($arr as $a){{\App\Model\Service::getServiceNameByNum($a)[0].' '}}@endforeach</span></p>
                <p><i class="am-icon-user-secret"></i> 造型师：<span>{{\App\Model\Designer::getDesignerNameById($designer_id)[0]}}</span></p>
                <p><i class="am-icon-calendar"></i> 赴约时间：<span>{{date('Y年m月d日 H:i:s', strtotime($start_time) - 60 * 60 * 8)}}</span></p>
                <p><i class="am-icon-clock-o"></i> 服务时长：<span>{{$total_time}} 分钟</span></p>
                <p><i class="am-icon-yen"></i> 订单总额：<span>{{$service_price}} 元</span></p>
            </div>
            <section>
                <h3>您的可用优惠券如下，请按需选择使用：</h3>
                <ul class="am-avg-sm-1 am-avg-md-4 am-avg-lg-4 am-thumbnails list-paddingleft-2">
                    @if(count($oTickets) != 0)
                        @foreach($oTickets as $ticket)
                            <li>
                                <div class="m-contact-infobox">
                                    <span style="float: left;margin: 5px 5px;">金鹰发艺</span>
                                    <h2 style="margin: 40px 0 0;text-align: center;font-family: 华文彩云;cursor: pointer;" onclick="selectTicket(this, '{{$ticket->type}}', '{{$ticket->quota}}');">
                                        @if($ticket->type == 1)
                                            5元新人优惠券 &times; {{$ticket->num}} 张
                                        @elseif($ticket->type == 2)
                                            10元代金券 &times; {{$ticket->num}} 张
                                        @elseif($ticket->type == 3)
                                            {{$ticket->quota}}元限时优惠券 &times; {{$ticket->num}} 张
                                        @else
                                            {{$ticket->quota}}元会员专享月券 &times; {{$ticket->num}} 张
                                        @endif
                                    </h2>
                                    <h3 style="text-align: center;">
                                        <p>&nbsp;</p>
                                        <div style="display: none;">
                                            <button class="am-btn am-btn-danger am-btn-xs" onclick="calculateMoney(this, '{{$ticket->type}}', '{{$ticket->num}}', '{{$ticket->quota}}', 1);"><i class="am-icon-plus"></i></button>
                                            <span>1</span>
                                            <button class="am-btn am-btn-primary am-btn-xs" onclick="calculateMoney(this, '{{$ticket->type}}', '{{$ticket->num}}', '{{$ticket->quota}}', 0);"><i class="am-icon-minus"></i></button>
                                        </div>
                                    </h3>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li>
                            <div style="border: 1px solid #D8D8D8;background: lightgray;	border-radius: 5px;">
                                <span style="float: left;margin: 5px 5px;">温馨提示</span>
                                <h2 style="margin: 40px 0 0;text-align: center;">
                                    暂无可用优惠券
                                </h2>
                                <h3 style="text-align: center;">
                                    <p>&nbsp;</p>
                                </h3>
                            </div>
                        </li>
                    @endif
                </ul>
                <h3>您的最终待支付款项如下，请选择支付方式进行支付：</h3>
                <p><i class="am-icon-hand-o-right"></i> 经计算，您共需支付：<span style="color: red;font-size: 18pt; font-weight: bold;">&yen;</span> <span id="terminal_money" style="color: red;font-size: 18pt; font-weight: bold;">{{$service_price}}</span>，线上付款 <i style="font-style: italic;">(推荐)</i> 可获得服务对应发币及信誉值。</p>
                <div class="am-u-sm-12 pay-method">
                    <div class="am-u-md-4" onclick="doPay(1);"><div><img src="{{asset('assets/img/ddfk.png')}}" width="23" alt=""> 到店付款</div></div>
                    <div class="am-u-md-4" onclick="doPay(2);"><div><img src="{{asset('assets/img/yezf.png')}}" width="23" alt=""> 余额支付(荐)</div></div>
                    <div class="am-u-md-4" onclick="doPay(3);"><div><img src="{{asset('assets/img/zfbzf.png')}}" width="23" alt=""> 支付宝支付(荐)</div></div>
                </div>
            </section>
        </article>
    </div>
    <script>
        //定义存放卡券领取记录id数组
        var aId = [];
        function selectTicket(obj, type, quota) {
            var now_money = parseInt($("#terminal_money").html());
            if($(obj).parent().hasClass('m-contact-infobox')){
                if(now_money - quota < 0){
                    tip("禁用该卡券");
                    return false;
                }else {
                    $("#terminal_money").html(now_money - quota);
                    $(obj).next().children('p').hide();
                    $(obj).next().children('div').show();
                    $(obj).parent().removeClass('m-contact-infobox').addClass('ticket-click');
                    changeIdaArr(type, quota, 0, 1, 1);
                }
            }else {
                var num = parseInt($(obj).next().children('div').children('span').html());
                $("#terminal_money").html(now_money + quota * num);
                $(obj).next().children('div').hide();
                $(obj).next().children('p').show();
                $(obj).next().children('div').children('span').html(1);
                $(obj).parent().removeClass('ticket-click').addClass('m-contact-infobox');
                changeIdaArr(type, quota, 0, num, 0);
            }
        }

        function calculateMoney(obj, type, num, quota, flag) {
            var  temp = 0;
            var now_money = parseInt($("#terminal_money").html());
            if (flag == 1){
                temp = parseInt($(obj).next().html());
                if(temp+1>num){
                    return false;
                }else {
                    if (now_money - quota < 0){
                        tip("已超额，禁用");
                        return false;
                    }else {
                        $(obj).next().html(temp+1);
                        $("#terminal_money").html(now_money - quota);
                        changeIdaArr(type, quota, temp, 1, 1);
                    }
                }
            }else {
                temp = parseInt($(obj).prev().html());
                if(temp-1<1){
                    return false;
                }else {
                    $(obj).prev().html(temp-1);
                    $("#terminal_money").html(now_money + parseInt(quota));
                    changeIdaArr(type, quota, temp-1, 1, 0);
                }
            }
        }

        //ajax获取卡券领取数组
        function changeIdaArr(type, quota, skip, take, flag) {
            $.post(
                '/ticket-id',
                {
                    _token: $("input[name='_token']").val(),
                    type: type,
                    quota: quota,
                    aId: aId,
                    skip: skip,
                    take: take,
                    flag: flag
                },
                function (data) {
                    aId = data.arr;
                    // console.log(aId);
                },
                'json'
            );
        }
    </script>
@endsection