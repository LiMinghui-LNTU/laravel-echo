<script src="{{asset('assets/js/echarts.min.js')}}"></script>
<!-- 内容区域 -->
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf"><i class="am-icon-reply" style="cursor: pointer;" onclick="window.history.go(-1);"></i> 网站顾客流量</div>
                    </div>
                    <div class="widget-body  am-fr">
                        <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
                        <div id="main" style="width: 100%;height:500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var dom = document.getElementById("main");
    var myChart = echarts.init(dom);
    option = null;
    option = {
        title: {
            top: 30,
            left: 'center',
            text: new Date().getFullYear()+'年网站日服务顾客量'
        },
        tooltip : {},
        visualMap: {
            min: 0,
            max: "{{$iMax}}",
            type: 'piecewise',
            orient: 'horizontal',
            left: 'center',
            top: 65,
            textStyle: {
                color: '#000'
            }
        },
        calendar: {
            top: 120,
            left: 30,
            right: 30,
            cellSize: ['auto', 22],
            range: new Date().getFullYear(),
            itemStyle: {
                normal: {borderWidth: 0.5}
            },
            yearLabel: {show: false}
        },
        series: {
            type: 'heatmap',
            coordinateSystem: 'calendar',
            data: {!! $sData !!}
        }
    };

    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>