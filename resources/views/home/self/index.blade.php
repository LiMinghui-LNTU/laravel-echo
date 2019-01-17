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
                        <div class="am-u-md-1">
                            <img class="am-img-circle am-img-thumbnail"
                                 src="http://s.amazeui.org/media/i/demos/bw-2014-06-19.jpg?imageView/1/w/200/h/200/q/80"
                                 alt=""/>
                        </div>
                        <div class="am-u-md-4">
                            <label class="am-u-sm-4 am-form-label">账号：</label>
                            <div class="am-u-sm-8">
                                <small>13582853262</small>
                            </div>
                            <label class="am-u-sm-4 am-form-label">昵称：</label>
                            <div class="am-u-sm-8">
                                <small>包子入侵</small>
                            </div>
                            <label class="am-u-sm-4 am-form-label">优惠券：</label>
                            <div class="am-u-sm-8">
                                <small>3张</small>
                            </div>
                            <label class="am-u-sm-4 am-form-label">头衔：</label>
                            <div class="am-u-sm-8">
                                <small>钻石VIP</small>
                            </div>
                            <button class="am-btn am-btn-primary am-btn-xs">
                                <i class="am-icon-edit"></i>
                                编辑信息
                            </button>
                        </div>
                        <div class="am-u-md-7">
                            <div class="user-info">
                                <p>金鹰发币</p>
                                <div class="am-progress am-progress-sm">
                                    <div class="am-progress-bar" style="width: 60%"></div>
                                </div>
                                <p class="user-info-order">当前发币：<strong>83枚</strong> 可抵现金：<strong>&yen;8.30元</strong>
                                </p>
                            </div>
                            <div class="user-info">
                                <p>信誉积分</p>
                                <div class="am-progress am-progress-sm">
                                    <div class="am-progress-bar am-progress-bar-success" style="width: 80%"></div>
                                </div>
                                <p class="user-info-order">信用等级：正常当前 信用积分：<strong>80</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="am-panel am-panel-default">
                <div class="am-panel-bd am-u-md-6">
                    <div data-am-widget="tabs" class="am-tabs am-tabs-d2">
                        <ul class="am-tabs-nav am-cf">
                            <li class="am-active"><a href="[data-tab-panel-0]">全部订单</a></li>
                            <li class=""><a href="[data-tab-panel-1]">待赴约订单</a></li>
                            <li class=""><a href="[data-tab-panel-2]">已完成订单</a></li>
                            <li class=""><a href="[data-tab-panel-3]">失约订单</a></li>
                        </ul>
                        <div class="am-tabs-bd">
                            <div data-tab-panel-0 class="am-tab-panel am-active">
                                <div class="am-scrollable-vertical">
                                    <table class="am-table am-table-bordered am-table-striped am-text-nowrap am-table-compact">
                                        <thead>
                                        <tr>
                                            <th>订单号</th>
                                            <th>服务类型</th>
                                            <th>造型师</th>
                                            <th>预定金额</th>
                                            <th>订单状态</th>
                                            <th>创建时间</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>JY88D5RF</td>
                                            <td>剪发</td>
                                            <td>瓜瓜</td>
                                            <td>&yen;20</td>
                                            <td>已完成</td>
                                            <td>2018-12-03 16:52:36</td>
                                        </tr>
                                        <tr>
                                            <td>JYS44EWF</td>
                                            <td>离子拉直</td>
                                            <td>倩倩</td>
                                            <td>&yen;130</td>
                                            <td>待赴约</td>
                                            <td>2018-12-18 10:20:05</td>
                                        </tr>
                                        <tr class="am-active">
                                            <td>JYSX8552</td>
                                            <td>剪刘海</td>
                                            <td>琪琪</td>
                                            <td>&yen;12</td>
                                            <td>失约</td>
                                            <td>2018-10-06 09:52:14</td>
                                        </tr>
                                        <tr>
                                            <td>JY247DEC</td>
                                            <td>营养护理</td>
                                            <td>甜甜</td>
                                            <td>&yen;258</td>
                                            <td>已完成</td>
                                            <td>2018-09-07 12:36:25</td>
                                        </tr>
                                        <tr>
                                            <td>JYA44SWX</td>
                                            <td>生化烫</td>
                                            <td>华子</td>
                                            <td>&yen;120</td>
                                            <td>已完成</td>
                                            <td>2018-09-13 08:36:14</td>
                                        </tr>
                                        <tr>
                                            <td>JY11A1XC</td>
                                            <td>黑发</td>
                                            <td>小七</td>
                                            <td>&yen;68</td>
                                            <td>待赴约</td>
                                            <td>2018-12-12 13:25:10</td>
                                        </tr>
                                        <tr>
                                            <td>JY77CD85</td>
                                            <td>数码烫</td>
                                            <td>欢欢</td>
                                            <td>&yen;238</td>
                                            <td>失约</td>
                                            <td>2018-12-19 11:08:06</td>
                                        </tr>
                                        <tr>
                                            <td>JY2V99BT</td>
                                            <td>彩色染色</td>
                                            <td>阿果</td>
                                            <td>&yen;168</td>
                                            <td>已完成</td>
                                            <td>2018-12-05 18:17:11</td>
                                        </tr>
                                        <tr>
                                            <td>JYX77XD1</td>
                                            <td>造型</td>
                                            <td>王子</td>
                                            <td>&yen;25</td>
                                            <td>失约</td>
                                            <td>2018-12-01 11:25:25</td>
                                        </tr>
                                        <tr>
                                            <td>JY02C6DB</td>
                                            <td>洗发</td>
                                            <td>阿成</td>
                                            <td>&yen;18</td>
                                            <td>待赴约</td>
                                            <td>2018-12-18 07:13:40</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div data-tab-panel-1 class="am-tab-panel ">
                                <div class="am-scrollable-vertical">
                                    <table class="am-table am-table-bordered am-table-striped am-text-nowrap am-table-compact">
                                        <thead>
                                        <tr>
                                            <th>订单号</th>
                                            <th>服务类型</th>
                                            <th>预定金额</th>
                                            <th>赴约时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>JYS44EWF</td>
                                            <td>离子拉直</td>
                                            <td>&yen;130</td>
                                            <td>2018-12-20 10:30:00</td>
                                            <td>
                                                <a href="javascript:;">
                                                    <i class="am-icon-pencil am-btn-group am-btn-group-xs"></i> <small>修改</small>
                                                </a>
                                                <a href="javascript:;" class="tpl-table-black-operation-del">
                                                    <i class="am-icon-trash am-btn-group am-btn-group-xs"></i> <small>退订</small>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JY11A1XC</td>
                                            <td>黑发</td>
                                            <td>&yen;68</td>
                                            <td>2018-12-15 12:00:00</td>
                                            <td>
                                                <a href="javascript:;">
                                                    <i class="am-icon-pencil am-btn-group am-btn-group-xs"></i> <small>修改</small>
                                                </a>
                                                <a href="javascript:;" class="tpl-table-black-operation-del">
                                                    <i class="am-icon-trash am-btn-group am-btn-group-xs"></i> <small>退订</small>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JY02C6DB</td>
                                            <td>洗发</td>
                                            <td>&yen;18</td>
                                            <td>2018-12-20 13:30:00</td>
                                            <td>
                                                <a href="javascript:;">
                                                    <i class="am-icon-pencil am-btn-group am-btn-group-xs"></i> <small>修改</small>
                                                </a>
                                                <a href="javascript:;" class="tpl-table-black-operation-del">
                                                    <i class="am-icon-trash am-btn-group am-btn-group-xs"></i> <small>退订</small>
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div data-tab-panel-2 class="am-tab-panel ">
                                <div class="am-scrollable-vertical">
                                    <table class="am-table am-table-bordered am-table-striped am-text-nowrap am-table-compact">
                                        <thead>
                                        <tr>
                                            <th>订单号</th>
                                            <th>服务类型</th>
                                            <th>造型师</th>
                                            <th>订单金额</th>
                                            <th>完成时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>JY88D5RF</td>
                                            <td>剪发</td>
                                            <td>瓜瓜</td>
                                            <td>&yen;20</td>
                                            <td>2018-12-04 11:52:36</td>
                                            <td>
                                                <a href="javascript:;" class="tpl-table-black-operation-del">
                                                    <i class="am-icon-trash am-btn-group am-btn-group-xs"></i> <small>删除</small>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JY247DEC</td>
                                            <td>营养护理</td>
                                            <td>甜甜</td>
                                            <td>&yen;258</td>
                                            <td>2018-09-10 08:03:05</td>
                                            <td>
                                                <a href="javascript:;" class="tpl-table-black-operation-del">
                                                    <i class="am-icon-trash am-btn-group am-btn-group-xs"></i> <small>删除</small>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JYA44SWX</td>
                                            <td>生化烫</td>
                                            <td>华子</td>
                                            <td>&yen;120</td>
                                            <td>2018-09-14 11:50:07</td>
                                            <td>
                                                <a href="javascript:;" class="tpl-table-black-operation-del">
                                                    <i class="am-icon-trash am-btn-group am-btn-group-xs"></i> <small>删除</small>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>JY2V99BT</td>
                                            <td>彩色染色</td>
                                            <td>阿果</td>
                                            <td>&yen;168</td>
                                            <td>2018-12-05 18:17:11</td>
                                            <td>
                                                <a href="javascript:;" class="tpl-table-black-operation-del">
                                                    <i class="am-icon-trash am-btn-group am-btn-group-xs"></i> <small>删除</small>
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div data-tab-panel-3 class="am-tab-panel ">
                                <div class="am-scrollable-vertical">
                                    <table class="am-table am-table-bordered am-table-striped am-text-nowrap am-table-compact">
                                        <thead>
                                        <tr>
                                            <th>订单号</th>
                                            <th>服务类型</th>
                                            <th>造型师</th>
                                            <th>预定金额</th>
                                            <th>失约时间</th>
                                            <th>信誉值</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="am-active">
                                            <td>JYSX8552</td>
                                            <td>剪刘海</td>
                                            <td>琪琪</td>
                                            <td>&yen;12</td>
                                            <td>2018-10-10 12:30:00</td>
                                            <td>-10</td>
                                        </tr>
                                        <tr>
                                            <td>JY77CD85</td>
                                            <td>数码烫</td>
                                            <td>欢欢</td>
                                            <td>&yen;238</td>
                                            <td>2018-12-20 07:30:00</td>
                                            <td>-100</td>
                                        </tr>
                                        <tr>
                                            <td>JYX77XD1</td>
                                            <td>造型</td>
                                            <td>王子</td>
                                            <td>&yen;25</td>
                                            <td>2018-12-02 10:00:00</td>
                                            <td>-10</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="am-panel-bd am-u-md-6">
                    <div class="am-form-group">
                        <label for="doc-ta-1">留言区域</label><br>
                        <textarea style="width: 100%;overflow: auto;word-break: break-all;resize: none;" rows="8" id="doc-ta-1"></textarea>
                    </div>
                    <div class="am-btn-group">
                        <button type="button" class="am-btn-primary am-round">
                            <i class="am-icon-envelope"></i>
                            <span class="am-badge am-badge-danger am-round">4</span>
                        </button>
                        <button type="button" class="am-btn-warning am-round">
                            留言
                            <i class="am-icon-send"></i>
                        </button>
                        <button type="button" class="am-btn-danger am-round">
                            预定
                            <i class="am-icon-send"></i>
                        </button>
                        <button type="button" class="am-btn-default am-round">
                            登出
                            <i class="am-icon-sign-out"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection