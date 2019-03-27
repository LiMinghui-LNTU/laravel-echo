<!-- 内容区域 -->
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf">{{$sTitle}}</div>
                    </div>
                    <div class="widget-body  am-fr">

                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                            <div class="am-form-group">
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"
                                                onclick="window.location.href='ticket/create';">
                                            <span class="am-icon-plus"></span> 新增
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="am-u-sm-12" id="people-list">
                            @csrf
                            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>票券图片</th>
                                    <th>类型</th>
                                    <th>面额</th>
                                    <th>发放量</th>
                                    <th>剩余量</th>
                                    <th>发放时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oTickets as $ticket)
                                    <tr class="gradeX">
                                        <td>{{$ticket->id}}</td>
                                        <td>
                                            <img src="{{$ticket->picture}}" width="100">
                                        </td>
                                        <td>
                                            @switch($ticket->type)
                                                @case(1)
                                                    {{'新人券'}}
                                                    @break
                                                @case(2)
                                                    {{'代金券'}}
                                                    @break
                                                @case(3)
                                                    {{'限时券'}}
                                                    @break
                                                @case(4)
                                                    {{'月券'}}
                                                    @break
                                                @default
                                                    {{'发币券'}}
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>{{$ticket->quota}}@if($ticket->type == 5) 个 @else 元 @endif</td>
                                        <td>{{$ticket->count}} 张</td>
                                        <td>{{$ticket->remain}} 张</td>
                                        <td>{{$ticket->created_at}}</td>
                                        <td>
                                            <div class="tpl-table-black-operation">
                                                <a href="/admin/ticket/{{$ticket->id}}/edit"
                                                   class="tpl-table-black-operation">
                                                    <i class="am-icon-edit"></i> 编辑
                                                </a>
                                                <a href="javascript:doDestroy('{{$ticket->id}}', 'ticket');"
                                                   class="tpl-table-black-operation-del">
                                                    <i class="am-icon-trash"></i> 删除
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- more data -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>