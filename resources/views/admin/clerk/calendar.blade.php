<!-- 内容区域 -->
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf">日程管理</div>
                    </div>
                    <div class="widget-body  am-fr">

                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                            <div class="am-form-group">
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span
                                                    class="am-icon-plus"></span> 创建日程
                                        </button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"
                                                onclick="window.location.href='/admin/calendar-list';"><span
                                                    class="am-icon-list"></span> 日程列表
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                            <div class="am-form-group tpl-table-list-select">
                                <select data-am-selected="{btnSize: 'sm'}">
                                    <option value="option1">所有类别</option>
                                    <option value="option2">IT业界</option>
                                    <option value="option3">数码产品</option>
                                    <option value="option3">笔记本电脑</option>
                                    <option value="option3">平板电脑</option>
                                    <option value="option3">只能手机</option>
                                    <option value="option3">超极本</option>
                                </select>
                            </div>
                        </div>
                        <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                            <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                <input type="text" class="am-form-field ">
                                <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search"
                    type="button"></button>
          </span>
                            </div>
                        </div>

                        <div class="am-u-sm-12">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="title">
<input type="hidden" id="start">
<input type="hidden" id="end">


<script type="text/javascript">
    $(document).ready(function () {
        // $('#calendar').fullCalendar( 'incrementDate', {days:5, hour, minutes:0} ); //日期视图向前或向后移动固定的时间，duration可以为={ days:1, hours:23, minutes:59 }
        $('#calendar').fullCalendar({
            events: eval('{!! $oSchedule !!}'),

            header: {
                left: '',
                center: '',
                right: ''
            },
            height: window.innerHeight - 10,
            windowResize: function (view) {
                $('#calendar').fullCalendar('option', 'height', window.innerHeight - 10);
            },
            // defaultView: 'agendaWeek',//日历初始化时默认视图
            defaultView: 'agendaFiveDay',
            views: {
                agendaFiveDay: {
                    type: 'agenda',
                    duration: {days: 5}
                }
            },
            // timezone: 'Asia/Shanghai',
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
            defaultDate: '{{date('Y-m-d')}}',
            lang: 'zh-cn',
            navLinks: false, // can click day/week names to navigate views
            selectable: true,
            selectHelper: true,
            select: function (start, end) {
                var title = prompt('填写标题:');
                var eventData;
                if (title) {
                    eventData = {
                        'title': title,
                        'start': start,
                        'end': end,
                        block: true
                    };
                    $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                    $("#title").val(title);
                    $("#start").val(start);
                    $("#end").val(end);
                    // alert(start)
                    createSchedule($("#title").val(), $("#start").val(), $("#end").val());
                }
                $('#calendar').fullCalendar('unselect');
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

    });

    function createSchedule(title, start, end) {
        $.post(
            '/admin/clerk',
            {'_token': "{{csrf_token()}}", 'title': title, 'start': start, 'end': end},
            function (data) {
                if (data.code != '1001') {
                    swal("入库失败!");
                }
            },
            'json'
        );
    }
</script>