@if($oMessages)
    <tr class="gradeX">
        <td>
            <span class="am-badge am-badge-primary am-round" id="{{$message->from}}-msg-{{$message->pre_type}}">1</span>
            @if($oMessages->pre_type == 4) {{\App\Model\Members::getNameById($oMessages->from)[0]}} @else {{\App\User::getUsernameById($oMessages->from)[0]}} @endif
        </td>
        <td>@if($oMessages->pre_type == 4) 顾客 @elseif($oMessages->pre_type == 3) 店员 @elseif($oMessages->pre_type == 2) 店长 @else 管理员 @endif</td>
        <td style="color: #0f0;">
            @if((strlen($oMessages->content) + mb_strlen($oMessages->content,'utf-8')) / 2 >= 50)
                {{mb_strimwidth($oMessages->content, 0, 50,'...', 'utf-8' )}}
            @else
                {{$oMessages->content}}
            @endif
        </td>
        <td>{{$oMessages->created_at}}</td>
        <td>
            <div class="tpl-table-black-operation">
                <a href="javascript:getMessage('{{$oMessages->from}}', '{{$oMessages->pre_type}}');">
                    <i class="am-icon-eye"></i> 查看
                </a>
                <a href="javascript:;" class="tpl-table-black-operation-del">
                    <i class="am-icon-trash"></i> 删除
                </a>
            </div>
        </td>
    </tr>
@endif