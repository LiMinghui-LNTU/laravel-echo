<!-- 内容区域 -->
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf">我的订单</div>
                    </div>
                    <div class="widget-body  am-fr">

                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                            <div class="am-form-group">
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span
                                                    class="am-icon-plus"></span> 新增
                                        </button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span
                                                    class="am-icon-save"></span> 保存
                                        </button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span
                                                    class="am-icon-archive"></span> 审核
                                        </button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span
                                                    class="am-icon-trash-o"></span> 删除
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
                                                @if($order->status == 2)
                                                    <a href="javascript:;">
                                                        <i class="am-icon-close"></i> 取消订单
                                                    </a>
                                                @endif
                                                @if($order->status == 1 || ($order->status == 3 && $order->pay == 0) || ($order->status == 3 && $order->pay == 2))
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                                @endif
                                                @if($order->pay == 1 && $order->status != 1)
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class="am-icon-undo"></i> 退款
                                                    </a>
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
                                    {!! $oOrders->render('vendor.pagination.default'); !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>