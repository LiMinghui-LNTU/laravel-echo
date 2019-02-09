@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
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
                <span><a href="/self" class="w-white">个人中心</a></span>
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12">
            <div class="am-panel am-panel-default">
                <div class="am-panel-bd">
                    <div class="am-g">
                        <div class="am-u-md-12">
                            <div data-am-widget="tabs" class="am-tabs am-tabs-default">
                                <ul class="am-tabs-nav am-cf">
                                    <li class="am-active">
                                        <a href="[data-tab-panel-0]">
                                            <i class="am-icon-hand-paper-o"></i>
                                            1/3选择服务项目
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="[data-tab-panel-1]">
                                            <i class="am-icon-user-secret"></i>
                                            2/3翻牌造型师
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="[data-tab-panel-2]">
                                            <i class="am-icon-clock-o"></i>
                                            3/3预定时间
                                        </a>
                                    </li>
                                </ul>
                                <div class="am-tabs-bd">
                                    <div data-tab-panel-0 class="am-tab-panel am-active">
                                        <div class="am-scrollable-vertical">
                                            <table class="am-table am-table-bordered am-table-striped am-text-nowrap am-table-compact">
                                                <thead>
                                                <tr>
                                                    <th>选择</th>
                                                    <th>服务单号</th>
                                                    <th>服务名称</th>
                                                    <th>
                                                        价位(
                                                        <input type="radio" name="type" checked="checked"
                                                               onclick="changePrice(1)">短发
                                                        <input type="radio" name="type" onclick="changePrice(2)">长发
                                                        )
                                                    </th>
                                                    <th>服务时长</th>
                                                    <th>信誉值</th>
                                                    <th>服务简介</th>
                                                </tr>
                                                </thead>
                                                <tbody id="short-hair">
                                                <?php $i = 0; ?>
                                                @foreach($oShortServices as $shortService)
                                                    <tr class="am-active" id="tr{{$i}}">
                                                        <td>
                                                            <input type="checkbox" name="order{{$i}}"
                                                                   onclick="checkPrice(this, '{{$i}}')">
                                                        </td>
                                                        <td id="number{{$i}}">
                                                        </td>
                                                        <td>
                                                            {{$shortService[0]->name}}
                                                        </td>
                                                        <td>
                                                            @foreach($oShortServices[$shortService[0]->name] as $obj)
                                                                <input type="radio" name="charge{{$i}}"
                                                                       onclick="showOrder('{{$i}}','{{$obj->number}}','{{$obj->continue_to}}','{{$obj->reputation_val}}','{{$obj->introduction}}')">
                                                                &yen;{{$obj->price}}
                                                            @endforeach
                                                        </td>
                                                        <td id="time{{$i}}"></td>
                                                        <td id="reputation{{$i}}"></td>
                                                        <td id="introduction{{$i}}"></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                                </tbody>
                                                <tbody id="long-hair" style="display: none;">
                                                <?php $j = $i; ?>
                                                @foreach($oLongServices as $longService)
                                                    <tr class="am-active" id="tr{{$j}}">
                                                        <td>
                                                            <input type="checkbox" name="order{{$j}}"
                                                                   onclick="checkPrice(this, '{{$j}}')">
                                                        </td>
                                                        <td id="number{{$j}}">
                                                        </td>
                                                        <td>
                                                            {{$longService[0]->name}}
                                                        </td>
                                                        <td>
                                                            @foreach($oLongServices[$longService[0]->name] as $obj)
                                                                <input type="radio" name="charge{{$j}}"
                                                                       onclick="showOrder('{{$j}}','{{$obj->number}}','{{$obj->continue_to}}','{{$obj->reputation_val}}','{{$obj->introduction}}')">
                                                                &yen;{{$obj->price}}
                                                            @endforeach
                                                        </td>
                                                        <td id="time{{$j}}"></td>
                                                        <td id="reputation{{$j}}"></td>
                                                        <td id="introduction{{$j}}"></td>
                                                    </tr>
                                                    <?php $j++; ?>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div data-tab-panel-1 class="am-tab-panel ">
                                        <input type="hidden" id="designer-checked">
                                        <ul class="news-content-ul am-scrollable-vertical">
                                            <?php $i = 0; $j = 0; ?>
                                            @foreach($oDesigners as $designer)
                                                @if($j % 2 == 0)
                                                    <li class="am-u-sm-12 am-u-md-3 am-u-lg-3">
                                                        <a href="#">
                                                            <div class=" am-u-sm-12 am-u-md-12 am-u-lg-5">
                                                                <div class="news-img">
                                                                    <img src="{{$designer->photo}}" class="am-circle"/>
                                                                </div>
                                                            </div>
                                                            <div class=" am-u-sm-12 am-u-md-12 am-u-lg-7">
                                                                <span class="news-right-title">{{$designer->name}}</span>
                                                                <p>{{$designer->title}}</p>
                                                                <p>
                                                                    @for($k = 0; $k < $designer->starts; $k++)
                                                                        <i class="am-icon-star"></i>
                                                                    @endfor
                                                                </p>
                                                                <button type="button"
                                                                        class="am-btn am-btn-primary am-round am-btn-xs"
                                                                        onclick="selectMe(this, '{{$designer->id}}')">
                                                                    选择他/她
                                                                </button>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="am-u-sm-12 am-u-md-3 am-u-lg-3">
                                                        <a href="#">
                                                            <div class=" am-u-sm-12 am-u-md-12 am-u-lg-4">
                                                                <span class="news-right-title">{{$designer->name}}</span>
                                                                <p>{{$designer->title}}</p>
                                                                <p>
                                                                    @for($k = 0; $k < $designer->starts; $k++)
                                                                        <i class="am-icon-star"></i>
                                                                    @endfor
                                                                </p>
                                                                <button type="button"
                                                                        class="am-btn am-btn-primary am-round am-btn-xs"
                                                                        onclick="selectMe(this, '{{$designer->id}}')">
                                                                    选择他/她
                                                                </button>
                                                            </div>
                                                            <div class=" am-u-sm-12 am-u-md-12 am-u-lg-5">
                                                                <div class="news-img">
                                                                    <img src="{{$designer->photo}}" class="am-circle"/>
                                                                </div>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </a>
                                                    </li>
                                                @endif
                                                <?php $i++; if ($i % 4 == 0) $j++; ?>
                                                @if($i != 0 && $i % 4 == 0)
                                                    <div class="clear"></div>
                                                    <hr>
                                                @endif
                                                @if($i == count($oDesigners))
                                                    <hr> @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div data-tab-panel-2 class="am-tab-panel ">
                                        <div id="designer-tip" style="color: #f00">请先选择造型师</div>
                                        <div id="service-tip" style="color: #0f9ae0;">您的服务总额为：<span
                                                    style="color: #f00;">&yen;</span><span id="service-price"
                                                                                           style="color: #f00;">0</span>，服务时长为：<span
                                                    id="service-time" style="color: #f00;">0</span>分钟。
                                        </div>
                                        <div id="calendar" style="display: none;"></div>
                                    </div>
                                    <button type="button" class="am-btn am-btn-danger am-btn-block" onclick="doReservation()">
                                        立即预定（Reservation）
                                    </button>
                                    <button type="button" class="am-btn am-btn-primary am-btn-block"
                                            onclick="window.location.href='/self';">我的订单（My Order）
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="_token" value="{{csrf_token()}}">
    <input type="hidden" id="start-time">
    <input type="hidden" id="end-time">
    <input type="hidden" id="designer-id">

    <script type="text/javascript">
        // $('#calendar').fullCalendar( 'incrementDate', {days:5, hour, minutes:0} ); //日期视图向前或向后移动固定的时间，duration可以为={ days:1, hours:23, minutes:59 }
        function selectMe(obj, id) {
            if ($("#service-price").text() == '0') {
                tip("请先选择服务项目");
                return false;
            }
            $("#designer-tip").hide();
            $("#calendar").show();
            $("#designer-id").val(id);
            $('#calendar').fullCalendar({
                events: [],
                header: {
                    left: '',
                    center: '',
                    right: ''
                },
                height: window.innerHeight - 120,
                windowResize: function (view) {
                    $('#calendar').fullCalendar('option', 'height', window.innerHeight - 120);
                },
                // defaultView: 'agendaWeek',//日历初始化时默认视图
                defaultView: 'agendaFiveDay',
                views: {
                    agendaFiveDay: {
                        type: 'agenda',
                        duration: {days: 5}
                    }
                },
                allDaySlot: false,//在agenda视图模式下，是否在日历上方显示all-day(全天)
                minTime: '8:00:00',//	设置显示的时间从几点开始
                maxTime: '23:00:00',//	设置显示的时间从几天结束
                slotEventOverlap: false,//	设置视图中的事件显示是否可以重叠覆盖
                slotLabelFormat: "H(:mm)a",//日期视图左边那一列显示的每一格日期时间格式
                timeFormat: 'H:mm',//事件按24小时制计算
                columnFormat: 'MM-DD',//每列头部信息
                monthNames: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
                monthNamesShort: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
                dayNames: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],
                dayNamesShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],
                aspectRatio: 1.976,
                // height:800,
                defaultDate: "{{date('Y-m-d')}}",
                lang: 'zh-cn',
                navLinks: false, // can click day/week names to navigate views
                selectable: true,
                selectHelper: true,
                select: function (start, end) {
                    var order_time = parseInt($("#service-time").text()); //预订时长
                    var eventData;
                    eventData = {
                        start: start,
                        end: end,
                        block: true
                    };
                    var select_time = (end - start) / 60000; //选择的预订时长
                    if (eventData) {
                        if ((select_time - order_time) < 0 || (select_time - order_time) >= 30) {
                            $('#calendar').fullCalendar('unselect');
                            tip("请勾选适当时长");
                            return false;
                        }else {
                            $("#start-time").val(start);
                            $("#end-time").val(end);
                        }
                    }
                },
                // defaultEventMinutes:60,
                editable: false,
                eventLimit: true, // allow /more" link when too many events
                slotEventOverlap: false,
                unselectAuto: false,
                selectOverlap: function (event) {
                    return !event.block;
                }
            });

            for (var i = 0; i < $(".am-tab-panel button").length; i++) {
                if ($(".am-tab-panel button")[i].className == 'am-btn am-btn-danger am-round am-btn-xs') {
                    $(".am-tab-panel button")[i].className = 'am-btn am-btn-primary am-round am-btn-xs';
                    $(".am-tab-panel button")[i].innerHTML = "选择他/她";
                }
            }
            obj.innerHTML = "<i class='am-icon-check-square-o'></i>已选";
            obj.className = "am-btn am-btn-danger am-round am-btn-xs";
            $("#designer-checked").val(id);

            //请求该造型师的日程
            var events = {
                url: "/get-schedule",
                type: 'POST',
                data: {
                    _token: "{{csrf_token()}}",
                    designer_id: id
                }
            };
            $('#calendar').fullCalendar('removeEventSource', events);
            $('#calendar').fullCalendar('addEventSource', events);
            // $('#calendar').fullCalendar('refetchEvents');

        }
    </script>
@endsection