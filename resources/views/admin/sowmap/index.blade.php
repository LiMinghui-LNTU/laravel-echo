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
                                                onclick="window.location.href='sowmap/create';">
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
                                    <th>轮播图</th>
                                    <th>跳转模块</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oSowmaps as $sowmap)
                                    <tr class="gradeX">
                                        <td>{{$sowmap->id}}</td>
                                        <td>
                                            <img src="{{$sowmap->thumb}}" width="100">
                                        </td>
                                        <td>{{\App\Model\Navigation::getNavByUrl($sowmap->redirect)->name}}</td>
                                        <td>{{$sowmap->created_at}}</td>
                                        <td>
                                            <div class="tpl-table-black-operation">
                                                <a href="/admin/sowmap/{{$sowmap->id}}" class="tpl-table-black-operation">
                                                    <i class="am-icon-first-order"></i> 优先显示
                                                </a>
                                                <a href="/admin/sowmap/{{$sowmap->id}}/edit" class="tpl-table-black-operation-del">
                                                    <i class="am-icon-edit"></i> 编辑
                                                </a>
                                                <a href="javascript:doDestroy('{{$sowmap->id}}', 'sowmap');" class="tpl-table-black-operation-del">
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