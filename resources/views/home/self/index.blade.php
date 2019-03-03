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
                            <img class="am-img-circle am-img-thumbnail" src="{{$oInfo->photo}}" alt=""/>
                        </div>
                        <div class="am-u-md-4">
                            <label class="am-u-sm-4 am-form-label">账号：</label>
                            <div class="am-u-sm-8">
                                <small>{{$oInfo->account_number}}</small>
                            </div>
                            <label class="am-u-sm-4 am-form-label">昵称：</label>
                            <div class="am-u-sm-8">
                                <small>{{$oInfo->nickname}}</small>
                            </div>
                            <label class="am-u-sm-4 am-form-label">优惠券：</label>
                            <div class="am-u-sm-8">
                                <small>{{$oInfo->ticket}}张</small>
                            </div>
                            <label class="am-u-sm-4 am-form-label">头衔：</label>
                            <div class="am-u-sm-8">
                                <small>{{$oInfo->title}}</small>
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
                                    <div class="am-progress-bar" style="width: {{$oInfo->coins}}%"></div>
                                </div>
                                <p class="user-info-order">当前发币：<strong>{{$oInfo->coins}}枚</strong>
                                    可抵现金：<strong>&yen;{{$oInfo->coins / 10}}元</strong>
                                </p>
                            </div>
                            <div class="user-info">
                                <p>信誉积分</p>
                                <div class="am-progress am-progress-sm">
                                    <div class="am-progress-bar am-progress-bar-success"
                                         style="width: {{$oInfo->reputation_value}}%"></div>
                                </div>
                                <p class="user-info-order">信用等级：极好 信用积分：<strong>{{$oInfo->reputation_value}}</strong>
                                </p>
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
                                        @foreach($oOrders as $order)
                                            <tr>
                                                <td>{{$order->order_number}}</td>
                                                <td>
                                                    @if(count(json_decode($order->service_number, true)) > 1)
                                                        综合服务
                                                    @else
                                                        {{\App\Model\Service::getServiceNameByNum(json_decode($order->service_number, true)[0])[0]}}
                                                    @endif
                                                </td>
                                                <td>{{\App\Model\Designer::getDesignerNameById($order->designer_id)[0]}}</td>
                                                <td>&yen;{{$order->total_money}}</td>
                                                <td>@if($order->status == 1)已完成@elseif($order->status == 2)待赴约@else
                                                        失约@endif</td>
                                                <td>{{$order->created_at}}</td>
                                            </tr>
                                        @endforeach
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
                                            <th>支付状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($oOrders as $order)
                                            @if($order->status == 2)
                                                <tr>
                                                    <td>{{$order->order_number}}</td>
                                                    <td>
                                                        @if(count(json_decode($order->service_number, true)) > 1)
                                                            综合服务
                                                        @else
                                                            {{\App\Model\Service::getServiceNameByNum(json_decode($order->service_number, true)[0])[0]}}
                                                        @endif
                                                    </td>
                                                    <td>&yen;{{$order->total_money}}</td>
                                                    <td>{{\App\Model\Schedule::getTimeById($order->schedule_id, 'start')[0]}}</td>
                                                    <td>
                                                        @if($order->pay == 0)
                                                            待付款
                                                        @elseif($order->pay == 1)
                                                            已支付
                                                        @else
                                                            已退款
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="javascript:;" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-trash am-btn-group am-btn-group-xs"></i>
                                                            <small>取消订单</small>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
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
                                        @foreach($oOrders as $order)
                                            @if($order->status == 1)
                                                <tr>
                                                    <td>{{$order->order_number}}</td>
                                                    <td>
                                                        @if(count(json_decode($order->service_number, true)) > 1)
                                                            综合服务
                                                        @else
                                                            {{\App\Model\Service::getServiceNameByNum(json_decode($order->service_number, true)[0])[0]}}
                                                        @endif
                                                    </td>
                                                    <td>{{\App\Model\Designer::getDesignerNameById($order->designer_id)[0]}}</td>
                                                    <td>&yen;{{$order->total_money}}</td>
                                                    <td>{{$order->updated_at}}</td>
                                                    <td>
                                                        <a href="javascript:;" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-trash am-btn-group am-btn-group-xs"></i>
                                                            <small>删除</small>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div data-tab-panel-3 class="am-tab-panel ">
                                <div class="am-scrollable-vertical">
                                    <table class="am-table am-table-bordered am-table-striped am-text-nowrap am-table-compact">
                                        <thead>
                                        <tr>
                                            <th>服务类型</th>
                                            <th>造型师</th>
                                            <th>预定金额</th>
                                            <th>失约时间</th>
                                            <th>信誉值</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($oOrders as $order)
                                            @if($order->status == 3)
                                                <tr class="am-active">
                                                    <td>
                                                        @if(count(json_decode($order->service_number, true)) > 1)
                                                            综合服务
                                                        @else
                                                            {{\App\Model\Service::getServiceNameByNum(json_decode($order->service_number, true)[0])[0]}}
                                                        @endif
                                                    </td>
                                                    <td>{{\App\Model\Designer::getDesignerNameById($order->designer_id)[0]}}</td>
                                                    <td>&yen;{{$order->total_money}}</td>
                                                    <td>{{\App\Model\Schedule::getTimeById($order->schedule_id, 'end')[0]}}</td>
                                                    <td>
                                                        -{{\App\Model\Service::calculateReputationValue(json_decode($order->service_number, true))}}</td>
                                                    <td>
                                                        @if($order->pay == 0)
                                                            未支付
                                                        @elseif($order->pay == 1)
                                                            <a href="javascript:;"
                                                               class="tpl-table-black-operation-del">
                                                                <i class="am-icon-money am-btn-group am-btn-group-xs"></i>
                                                                <small>申请退款</small>
                                                            </a>
                                                        @else
                                                            已退款
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="am-panel-bd am-u-md-6">
                    <div class="am-form-group" id="area">
                        <label for="doc-ta-1">留言区域</label><br>
                        <textarea style="width: 100%;overflow: auto;word-break: break-all;resize: none;" rows="8"
                                  id="comment-area"></textarea>
                    </div>
                    <ul class="am-comments-list am-comments-list-flip am-scrollable-vertical" id="message-content" style="display: none;">
                        @forelse($oMessages as $message)
                            @if($message->from == $oInfo->id && $message->pre_type == 4)
                            <li class="am-comment am-comment-flip am-comment-danger">
                                <a href="javascript:;">
                                    <img src="{{$oInfo->photo}}" alt="" class="am-comment-avatar" width="48" height="48">
                                </a>
                                <div class="am-comment-main">
                                    <header class="am-comment-hd">
                                        <div class="am-comment-meta">
                                            <a href="javascript:;" class="am-comment-author">{{$oInfo->nickname}}</a> 回复于
                                            <time title="{{date('Y年m月d日H:i:s', strtotime($message->created_at))}}">{{$message->created_at}}</time>
                                        </div>
                                    </header>
                                    <div class="am-comment-bd">
                                        <p>{{$message->content}}</p>
                                    </div>
                                </div>
                            </li>
                            @else
                                <?php $oUser = \App\User::findUser($message->from); ?>
                                <li class="am-comment am-comment-primary">
                                    <a href="javascript:;">
                                        <img src="{{$oUser->head_url}}" alt="" class="am-comment-avatar" width="48" height="48">
                                    </a>
                                    <div class="am-comment-main">
                                        <header class="am-comment-hd">
                                            <div class="am-comment-meta">
                                                <a href="javascript:;" class="am-comment-author">{{$oUser->username}}</a> 回复于
                                                <time title="{{date('Y年m月d日H:i:s', strtotime($message->created_at))}}">{{$message->created_at}}</time>
                                            </div>
                                        </header>
                                        <div class="am-comment-bd">
                                            <p>{{$message->content}}</p>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @empty
                            暂无消息
                        @endforelse
                    </ul>
                    <div class="am-btn-group">
                        <button type="button" class="am-btn-primary am-round" onclick="messages()">
                            <i class="am-icon-envelope"></i>
                            <span class="am-badge am-badge-danger am-round">4</span>
                        </button>
                        <button type="button" class="am-btn-warning am-round" onclick="leaveWords('{{$oInfo->id}}')">
                            留言
                            <i class="am-icon-send"></i>
                        </button>
                        <button type="button" class="am-btn-danger am-round"
                                onclick="window.location.href='self/create';">
                            预定
                            <i class="am-icon-hand-pointer-o"></i>
                        </button>
                        <button type="button" class="am-btn-default am-round" onclick="window.location.href='logout';">
                            登出
                            <i class="am-icon-sign-out"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection