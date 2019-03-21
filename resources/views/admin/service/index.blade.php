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
                                        <button type="button" class="am-btn am-btn-default am-btn-primary"
                                                onclick="importData();">
                                            <span class="am-icon-inbox"></span> 导入数据
                                        </button>
                                    </div>

                                    <div class="am-btn-group am-btn-group-xs">
                                        <div>
                                            <span style="color: #00e359;font-size: 10pt;" id="hide-name"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="am-u-sm-12" id="people-list">
                            @csrf
                            <input type="file" id="import-file" name="import-file" style="display: none;" onchange="uploadThumb('/admin/insert-file','import-file','','hide-name')">
                            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                <thead>
                                <tr>
                                    <th>服务名称</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oServiceNames as $serviceName)
                                    <tr class="gradeX">
                                        <td>{{$serviceName->name}}</td>
                                        <td>
                                            <div class="tpl-table-black-operation">
                                                <a href="/admin/service/{{$serviceName->name}}">
                                                    <i class="am-icon-eye"></i> 查看
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
<script>
    function importData() {
        Swal.fire({
            title: '数据导入提醒',
            html: "导入前请先下载<a href='{{asset('assets/import_demo/service_import_demo.xlsx')}}' style='font-weight: bold;'>模板文件</a>,并按要求填写",
            // type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#abc',
            confirmButtonText: '导入',
            cancelButtonText: '取消'
        }).then((result) => {
            if (result.value) {
                $("#import-file").click();
            }
        });
    }
</script>