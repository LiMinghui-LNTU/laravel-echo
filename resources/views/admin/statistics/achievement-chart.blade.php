<script src="{{asset('assets/js/echarts.common.min.js')}}"></script>
<!-- 内容区域 -->
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf">店员业绩统计图表</div>
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
                text: new Date().getFullYear() + '年业绩统计'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'cross',
                    crossStyle: {
                        color: '#999'
                    }
                }
            },
            legend: {
                data:{!! $sNames !!}
            },
            xAxis: {
                type: 'category',
                name:'月份',
                data: [1+'月',2+'月',3+'月',4+'月',5+'月',6+'月',7+'月',8+'月',9+'月',10+'月',11+'月',12+'月'],
                axisLabel:{
                    formatter: '{value}'
                },
                axisPointer: {
                    type: 'shadow'
                }
            },
            yAxis: {
                type: 'value',
                name: '服务人数',
                axisLabel: {
                    formatter: '{value}人'
                }
            },
            toolbox: {
                feature: {
                    dataView: {show: true, readOnly: false},
                    magicType: {show: true, type: ['line', 'bar']},
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            series: [{!! $sData !!}]
        });
</script>