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
                                                onclick="window.location.href='case/create';">
                                            <span class="am-icon-plus"></span> 新增
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
                                    <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button"></button>
                                </span>
                            </div>
                        </div>

                        <div class="am-u-sm-12" id="people-list">
                            @csrf
                            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>标签</th>
                                    <th>示例图</th>
                                    <th>发型名称</th>
                                    <th>是否显示</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oCases as $case)
                                    <tr class="gradeX">
                                        <td>{{$case->id}}</td>
                                        <td>
                                            @if($case->tag == 1)
                                                最新流行
                                            @elseif($case->tag == 2)
                                                男士风尚
                                            @elseif($case->tag == 3)
                                                女性潮流
                                            @else
                                                优秀作品
                                            @endif
                                        </td>
                                        <td>
                                            <img src="{{$case->thumb}}" width="30">
                                        </td>
                                        <td>{{$case->title}}</td>
                                        <td>
                                            <span class="tpl-switch">
                                                <input type="checkbox" onclick="doSwitch('{{$case->id}}', 'case', this)" class="ios-switch bigswitch tpl-switch-btn" @if($case->is_show) checked @endif>
                                                <div class="tpl-switch-btn-view">
                                                    <div>
                                                    </div>
                                                </div>
                                            </span>
                                        </td>
                                        <td>{{$case->created_at}}</td>
                                        <td>
                                            <div class="tpl-table-black-operation">
                                                <a href="/admin/case/{{$case->id}}/edit">
                                                    <i class="am-icon-pencil"></i> 编辑
                                                </a>
                                                <a href="javascript:doDestroy('{{$case->id}}', 'case');" class="tpl-table-black-operation-del">
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
                        <div class="am-u-lg-12 am-cf" id="paginate-nav">
                            <div class="am-fr">
                                @if($oCases)
                                    {!! $oCases->render('vendor.pagination/default'); !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>