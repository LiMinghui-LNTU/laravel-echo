@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
@section('content')
    <div class="toppic">
        <div class="am-container-1">
            <div class="toppic-title left">
                <i class="am-icon-money toppic-title-i"></i>
                <span class="toppic-title-span">优惠活动</span>
                <p>Preferential Activities</p>
            </div>
            <div class="right toppic-progress">
                <span><a href="/home" class="w-white">首页</a></span>
                <i class=" am-icon-arrow-circle-right w-white"></i>
                <span><a href="/activity" class="w-white">优惠活动</a></span>
            </div>
        </div>
    </div>

    @csrf
    <div class="am-container-1 news-content-all">
        <div class="left am-u-sm-12 am-u-md-8 am-u-lg-9 ">
            <ul class="news-ul">
                @foreach($oTickets as $ticket)
                    <li class="am-u-sm-12 am-u-md-6 am-u-lg-4 ">
                        <a href="javascript:;" style="cursor: text;">
                            <div class="news-ul-liall">
                                <img class="news-ul-liimg" src="{{$ticket->picture}}"/>
                                <div class="inform-list">
                                    <div class="inform-list-date"><i class="am-icon-clock-o"></i>发券时间：{{date('Y-m-d', strtotime($ticket->created_at))}}</div>
                                    <div class="inform-list-label"><i class="am-icon-ticket"></i>券名：
                                        @switch($ticket->type)
                                            @case(1)
                                                {{'新人优惠券'}}
                                                @break
                                            @case(2)
                                                {{'10元代金券'}}
                                                @break
                                            @case(3)
                                                {{'限时福利券'}}
                                                @break
                                            @case(4)
                                                {{'会员月券'}}
                                                @break
                                            @default
                                                {{'发币兑换券'}}
                                                @break
                                        @endswitch
                                    </div>
                                    <input type="hidden" id="remain{{$ticket->id}}" value="{{\App\Model\Ticket::getTicketRemain($ticket->type, $ticket->created_at)}}">
                                    <div id="remain-div{{$ticket->id}}" class="inform-list-numb"><i class="am-icon-arrow-circle-right"></i>剩余量：{{\App\Model\Ticket::getTicketRemain($ticket->type, $ticket->created_at)}}</div>
                                </div>
                                <span>
                                    @switch($ticket->type)
                                        @case(1)
                                            {{'新人优惠券'}}
                                            @break
                                        @case(2)
                                            {{'10元代金券'}}
                                            @break
                                        @case(3)
                                            {{'限时福利券'}}
                                            @break
                                        @case(4)
                                            {{'会员月券'}}
                                            @break
                                        @default
                                            {{'发币兑换券'}}
                                            @break
                                    @endswitch
                                </span>
                                <p>{{$ticket->condition}}</p>
                                @if($ticket->type == 2)
                                    <span class="see-more3" style="cursor: pointer;" onclick="coupon(2, '{{$ticket->id}}', this)"> 马上兑换 </span>
                                @elseif($ticket->type == 3)
                                    @if(session()->get('member') && \App\Model\TicketLog::hasLog(session()->get('member'), 3, $ticket->created_at))
                                        <span class="see-more3" style="cursor: text;color:#fff;background-color: gray;"> <i class="am-icon-check-circle-o"></i>已抢</span>
                                    @else
                                        <span class="timer see-more3" style="background-color: gray;color: #fff;cursor: text;"> </span>
                                        <span id="type3" class="see-more3" style="cursor: pointer;display: none;" onclick="coupon(3, '{{$ticket->id}}', this)"> 立即抢券 </span>
                                        <input type="hidden" name="timer" value="{{(strtotime($ticket->created_at)-time())*1000}}">
                                        <input type="hidden" name="hide-time" value="{{$ticket->created_at}}">
                                    @endif
                                @else
                                    @if(session()->get('member') && $ticket->type == 1 && \App\Model\TicketLog::hasLog(session()->get('member'), 1))
                                        <span class="see-more3" style="cursor: text;color:#fff;background-color: gray;"> <i class="am-icon-check-circle-o"></i>已领 </span>
                                    @elseif(session()->get('member') && $ticket->type == 4 && \App\Model\TicketLog::hasLog(session()->get('member'), 4))
                                        <span class="see-more3" style="cursor: text;color:#fff;background-color: gray;"> <i class="am-icon-check-circle-o"></i>本月已领</span>
                                    @elseif(session()->get('member') && $ticket->type == 5 && \App\Model\TicketLog::hasLog(session()->get('member'), 5))
                                        <span class="see-more3" style="cursor: text;color:#fff;background-color: gray;"> <i class="am-icon-check-circle-o"></i>今天已领</span>
                                    @else
                                        <span class="see-more3" style="cursor: pointer;" onclick="coupon('{{$ticket->type}}', '{{$ticket->id}}', this)"> 点击领取 </span>
                                    @endif
                                @endif
                            </div>
                        </a>
                    </li>
                @endforeach
                <li class="am-u-sm-12 am-u-md-6 am-u-lg-4 ">
                    <div class="news-ul-liall">
                        <img class="news-ul-liimg" src="{{asset('assets/img/jqqd.jpg')}}">
                        <div class="inform-list">
                            <div class="inform-list-date"><i class="am-icon-clock-o"></i>发券时间：未知</div>
                            <div class="inform-list-label"><i class="am-icon-ticket"></i>券名：
                                敬请期待
                            </div>
                            <div class="inform-list-numb"><i class="am-icon-arrow-circle-right"></i>剩余量：1W+</div>
                        </div>
                        <span>更多活动，敬请期待</span>
                        <p>本店将不定期推出各种优惠活动、发放各种票券供顾客参与抽取，欢迎各位新老顾客持续关注，感谢各位的大力支持！</p>
                        <span class="see-more3" style="cursor: text;color:#fff;background-color: gray;"> 敬请期待 </span>
                    </div>
                </li>
                <div class="clear"></div>
            </ul>
        </div>

        <div class="left am-u-sm-12 am-u-md-4 am-u-lg-3">

            <section data-am-widget="accordion" class="am-accordion am-accordion-gapped" data-am-accordion='{  }'>
                <div class="hot-title"><i class="am-icon-thumbs-o-up"></i>近期活动 / Recent Activities</div>
                <dl class="am-accordion-item am-active">
                    <dt class="am-accordion-title">
                        二月二，龙抬头，优惠券大放送
                    </dt>
                    <dd class="am-accordion-bd am-collapse am-in">
                        <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题， 加一个容器 -->
                        <div class="am-accordion-content">
                            本店将于二月二当天上午8点整发放88张限时抢现金抵扣券，速抢！
                        </div>
                    </dd>
                </dl>
                <dl class="am-accordion-item">
                    <dt class="am-accordion-title">
                        新人优惠券出炉啦
                    </dt>
                    <dd class="am-accordion-bd am-collapse ">
                        <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题， 加一个容器 -->
                        <div class="am-accordion-content">
                            即日起，凡是在本站注册为本店顾客，无论是否办理会员均可领取新人优惠券一张。该券仅限在线预订支付时进行现金抵扣。
                        </div>
                    </dd>
                </dl>
                <dl class="am-accordion-item">
                    <dt class="am-accordion-title">
                        代金券的使用规则要知道
                    </dt>
                    <dd class="am-accordion-bd am-collapse ">
                        <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题， 加一个容器 -->
                        <div class="am-accordion-content">
                            本店推出的代金券仅可使用自己账号中的发币兑换，兑换比例为100:1。发币可通过阅读养护知识模块中的文章获取，也可领取随机发币券积累发币。
                        </div>
                    </dd>
                </dl>
                <dl class="am-accordion-item">
                    <dt class="am-accordion-title">
                        告诉你，办理会员每月可领月券
                    </dt>
                    <dd class="am-accordion-bd am-collapse ">
                        <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题， 加一个容器 -->
                        <div class="am-accordion-content">
                            如果您是青铜及以上任一会员，您每月均可在本站领取月券一张，随机金额1~5元，可用于在线预约支付时抵用现金。
                        </div>
                    </dd>
                </dl>
                <dl class="am-accordion-item">
                    <dt class="am-accordion-title">
                        关于发币券的领取须知
                    </dt>
                    <dd class="am-accordion-bd am-collapse ">
                        <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题， 加一个容器 -->
                        <div class="am-accordion-content">
                            凡是注册的顾客每天均可领取发币券一张，会得到随机1~5个发币，该券不可直接抵用现金。一经发现盗券、刷券行为立即封号，永不解封！
                        </div>
                    </dd>
                </dl>

            </section>

        </div>

        <div class="clear"></div>
    </div>
    <script>
        $(function(){
            var duration = parseInt($("input[name='timer']").val());
            var note = $('.timer');
            var	ts = (new Date()).getTime() + duration;
            $('#countdown').countdown({
                timestamp	: ts,
                callback	: function(days, hours, minutes, seconds){
                    var message = "";
                    message += days * 24 + hours + "时";
                    message += minutes + "分";
                    message += seconds + "秒";
                    note.html(message);
                    if(days + minutes +seconds == 0){
                        note.attr("style","display: none;");
                        $("#type3").show();
                    }
                }
            });
        });

        //---领取优惠券---
        function coupon(type, id, obj) {
            if("{{is_null(session()->get('member'))}}"){
                tip("请先登录！");
                return false;
            }else {
                wait("正在领取...");
                var time = type == 3 ? $("input[name='hide-time']").val() : "";
                $.post(
                    '/activity',
                    {
                        _token : $("input[name='_token']").val(),
                        type : type,
                        time : time
                    },
                    function (data) {
                        if (data.code == '1001'){
                            var remain = parseInt($("#remain"+id).val()) - 1;
                            $("#remain-div"+id).html('<i class="am-icon-arrow-circle-right"></i>剩余量：' + remain);
                            if (type != 2){ //发币兑换的代金券不用置灰
                                $(obj).attr("onclick", "");
                                $(obj).attr("style", "cursor: text;color:#fff;background-color: gray;");
                            }
                            ticketTip(type, data.quota);
                            if(type == 1){
                                $(obj).html('<i class="am-icon-check-circle-o"></i>已领');
                            }
                            if(type == 3){
                                $(obj).html('<i class="am-icon-check-circle-o"></i>已抢');
                            }
                            if(type == 4){
                                $(obj).html('<i class="am-icon-check-circle-o"></i>本月已领');
                            }
                            if(type == 5){
                                $(obj).html('<i class="am-icon-check-circle-o"></i>今天已领');
                            }
                        }else {
                            tip(data.msg);
                            return false;
                        }
                    },
                    'json'
                );
            }
        }
    </script>
@endsection