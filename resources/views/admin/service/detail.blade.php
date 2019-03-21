<!-- 内容区域 -->
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                @include('admin.common.warning')
                @include('admin.common.error')
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
                                                onclick="window.location.href='/admin/service/create?name={{substr($sTitle, 14)}}';">
                                            <span class="am-icon-plus"></span> 添加服务
                                        </button>
                                    </div>
                                    <div class="am-btn-group am-btn-group-xs">
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"
                                                onclick="window.history.go(-1);">
                                            <span class="am-icon-reply"></span> 返回
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
                                    <th>服务单号</th>
                                    <th>类型</th>
                                    <th>价位</th>
                                    <th>服务时长</th>
                                    <th>信誉值</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oServices as $service)
                                    <tr class="gradeX">
                                        <td>{{$service->number}}</td>
                                        <td>
                                            @if($service->type == 1)
                                                短发
                                            @else
                                                长发
                                            @endif
                                        </td>
                                        <td>{{$service->price}}元</td>
                                        <td>{{$service->continue_to}}分钟</td>
                                        <td>{{$service->reputation_val}}</td>
                                        <td>{{$service->created_at}}</td>
                                        <td>
                                            <div class="tpl-table-black-operation">
                                                <a href="/admin/service/{{$service->id}}/edit">
                                                    <i class="am-icon-pencil"></i> 编辑
                                                </a>
                                                <a href="javascript:doDestroy('{{$service->id}}', 'service');" class="tpl-table-black-operation-del">
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