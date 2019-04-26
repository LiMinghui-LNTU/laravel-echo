<audio id="order-tip" preload="auto">
    <source src="{{asset('assets/audio/orderTip.mp3')}}" type="audio/mpeg" />
    Your browser does not support the audio element.
</audio>
<button id="play-order-tip" style="display: none;" onclick="document.getElementById('order-tip').play()"></button>
<!-- 内容区域 -->
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf">我的订单</div>
                    </div>
                    <form id="orderForm" class="widget-body  am-fr" method="get" action="/admin/clerk">
                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                            <div class="am-form-group tpl-table-list-select">
                                <select name="condition" data-am-selected="{btnSize: 'sm'}" onchange="$('#orderForm').submit();">
                                    <option value="0" @if(is_null($condition) || $condition == 0) selected @endif>全部状态</option>
                                    <option value="1" @if($condition == 1) selected @endif>已完成</option>
                                    <option value="2" @if($condition == 2) selected @endif>待赴约</option>
                                    <option value="3" @if($condition == 3) selected @endif>失约</option>
                                    <option value="4" @if($condition == 4) selected @endif>支付成功</option>
                                    <option value="5" @if($condition == 5) selected @endif>未支付</option>
                                    <option value="6" @if($condition == 6) selected @endif>已退款</option>
                                </select>
                            </div>
                        </div>
                        <div class="am-u-sm-12 am-u-md-12 am-u-lg-6">
                            <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                <input type="text" name="key" class="am-form-field" value="{{$key}}" placeholder="检索订单号，预订人昵称">
                                <span class="am-input-group-btn">
                                    <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button" onclick="$('#orderForm').submit();"></button>
                                </span>
                            </div>
                        </div>
                    </form>
                        @csrf
                        <div class="am-u-sm-12">
                            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                <thead>
                                <tr>
                                    <th>订单号</th>
                                    <th>预订人昵称</th>
                                    <th>预定项目</th>
                                    <th>预定总额</th>
                                    <th>订单状态</th>
                                    <th>支付状态</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody id="order-content">
                                @foreach($oOrders as $order)
                                    <tr>
                                        <td @if($order->is_read == 0)style="color: #ff0;cursor: pointer;" onclick="iKnow(this, '{{$order->id}}')" @endif>{{$order->order_number}}@if($order->is_read == 0)<span class="am-badge am-badge-danger am-round" style="color: #ff0;">new</span>@endif</td>
                                        <td data-am-popover="{content: '{{$order->title}}<br>{{$order->account_number}}', trigger: 'hover focus'}"
                                            style="color: orange;">
                                            {{$order->nickname}}
                                        </td>
                                        <td>
                                            <?php $aServiceNum = json_decode($order->service_number, true); $iCount = count($aServiceNum); ?>
                                            @for($i = 0; $i < $iCount; $i++)
                                                {{\App\Model\Service::getServiceNameByNum($aServiceNum[$i])[0]}}
                                                @if($i != $iCount-1),@endif
                                            @endfor
                                        </td>
                                        <td>&yen;{{$order->total_money}}</td>
                                        <td>
                                            @if($order->status == 1)已完成
                                            @elseif($order->status == 2)待赴约
                                            @else失约
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->pay == 0)未支付
                                            @elseif($order->pay == 1)支付成功
                                            @else已退款
                                            @endif
                                        </td>
                                        <td>{{$order->created_at}}</td>
                                        <td>
                                            <div class="tpl-table-black-operation">
                                                @if($order->status == 3)
                                                    @if($order->pay == 1)
                                                        <a href="javascript:changeOrderStatus('{{$order->id}}','refund');">
                                                            <i class="am-icon-reply"></i> 退款
                                                        </a>
                                                    @else
                                                        <a href="javascript:changeOrderStatus('{{$order->id}}','delete');">
                                                            <i class="am-icon-trash"></i> 删除
                                                        </a>
                                                    @endif
                                                @endif
                                                @if($order->status == 2)
                                                    @if($order->pay == 2)
                                                        <a href="javascript:changeOrderStatus('{{$order->id}}','delete');">
                                                            <i class="am-icon-trash"></i> 删除
                                                        </a>
                                                    @elseif($order->pay == 0)
                                                        <a href="javascript:changeOrderStatus('{{$order->id}}','ok');">
                                                            <i class="am-icon-check"></i> 已完成
                                                        </a>
                                                        <a href="javascript:changeOrderStatus('{{$order->id}}','break');">
                                                            <i class="am-icon-close"></i> 失约
                                                        </a>
                                                    @else
                                                        <a href="javascript:changeOrderStatus('{{$order->id}}','ok');">
                                                            <i class="am-icon-check"></i> 已完成
                                                        </a>
                                                        <a href="javascript:changeOrderStatus('{{$order->id}}','refund');">
                                                            <i class="am-icon-reply"></i> 退款
                                                        </a>
                                                        <a href="javascript:changeOrderStatus('{{$order->id}}','break');">
                                                            <i class="am-icon-close"></i> 失约
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- more data -->
                                </tbody>
                            </table>
                        </div>
                        <div class="am-u-lg-12 am-cf">

                            <div class="am-fr">
                                @if($oOrders)
                                    {!! $oOrders->appends(['condition'=>\Illuminate\Support\Facades\Input::get('condition'),'key'=>\Illuminate\Support\Facades\Input::get('key')])->render('vendor.pagination.default'); !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>