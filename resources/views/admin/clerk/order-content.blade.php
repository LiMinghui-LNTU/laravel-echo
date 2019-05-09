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