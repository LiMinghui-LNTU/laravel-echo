<script src="{{asset('assets/js/echarts.common.min.js')}}"></script>
<!-- 内容区域 -->
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf"><i class="am-icon-reply" style="cursor: pointer;" onclick="window.history.go(-1);"></i> 店员业绩统计图表</div>
                    </div>
                    <div class="widget-body  am-fr">
                        <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
                        <div id="main" style="width: 1200px;height:500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main'));
    myChart.setOption({
        title: {
            text: '已注册顾客会员类型统计',
            subtext: '截止至今',
            x: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                // magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: {!! $sVipNames !!}
        },
        series: [
            {
                name: '办理人数',
                type: 'pie',
                radius: '55%',
                center: ['50%', '60%'],
                data: [{!! $sData !!}],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    });
</script>