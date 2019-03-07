@if($oMyMessages)
    @foreach($oMyMessages as $message)
        <tr class="gradeX">
            <td>
                <span class="am-badge am-badge-primary am-round" id="{{$message->from}}-msg-{{$message->pre_type}}">@if($message->need_read > 0) {{$message->need_read}} @endif</span>
                @if($message->pre_type == 4) {{\App\Model\Members::getNameById($message->from)[0]}} @else {{\App\User::getUsernameById($message->from)[0]}} @endif
            </td>
            <td>@if($message->pre_type == 4) 顾客 @elseif($message->pre_type == 3) 店员 @elseif($message->pre_type == 2) 店长 @else 管理员 @endif</td>
            <td style="color: #0f0;">
                @if((strlen($message->content) + mb_strlen($message->content,'utf-8')) / 2 >= 50)
                    {{mb_strimwidth($message->content, 0, 50,'...', 'utf-8' )}}
                @else
                    {{$message->content}}
                @endif
            </td>
            <td>{{$message->created_at}}</td>
            <td>
                <div class="tpl-table-black-operation">
                    <a href="javascript:getMessage('{{$message->from}}', '{{$message->pre_type}}');">
                        <i class="am-icon-eye"></i> 查看
                    </a>
                    <a href="javascript:;" class="tpl-table-black-operation-del">
                        <i class="am-icon-trash"></i> 删除
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
@endif