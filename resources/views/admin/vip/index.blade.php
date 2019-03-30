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
                                                onclick="window.location.href='vip/create';">
                                            <span class="am-icon-plus"></span> 添加会员卡
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
                                    <th>卡片样图</th>
                                    <th>会员名称</th>
                                    <th>办理金额</th>
                                    <th>折扣</th>
                                    <th>奖励信誉值</th>
                                    <th>奖励发币</th>
                                    <th>办理人数</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oVips as $vip)
                                    <tr class="gradeX">
                                        <td>{{$vip->id}}</td>
                                        <td>
                                            <img src="{{$vip->picture}}" width="100">
                                        </td>
                                        <td>{{$vip->title}}</td>
                                        <td>{{$vip->charge}}</td>
                                        <td>{{$vip->discount}}</td>
                                        <td>{{$vip->reputation_value}} 个</td>
                                        <td>{{$vip->coins}} 枚</td>
                                        <td>{{$vip->handle_count}}</td>
                                        <td>
                                            <div class="tpl-table-black-operation">
                                                <a href="/admin/vip/{{$vip->id}}/edit"
                                                   class="tpl-table-black-operation">
                                                    <i class="am-icon-edit"></i> 编辑
                                                </a>
                                                <a href="javascript:doDestroy('{{$vip->id}}', 'vip');"
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