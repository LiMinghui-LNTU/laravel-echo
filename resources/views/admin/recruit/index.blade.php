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
                                                onclick="window.location.href='recruit/create';">
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
                                    <th>招聘职位</th>
                                    <th>职位缩略图</th>
                                    <th>应聘人数</th>
                                    <th>创建时间</th>
                                    <th>是否发布</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oInfo as $info)
                                    <tr class="gradeX">
                                        <td>{{$info->id}}</td>
                                        <td>{{$info->position}}</td>
                                        <td>
                                            <img src="{{$info->thumb}}" width="30">
                                        </td>
                                        <td>
                                            @if($info->count > 0)
                                                <a href="/admin/resume/{{$info->id}}">{{$info->count}}</a>
                                            @else
                                                {{$info->count}}
                                            @endif
                                        </td>
                                        <td>{{$info->created_at}}</td>
                                        <td>
                                            <span class="tpl-switch">
                                                <input type="checkbox" onclick="doSwitch('{{$info->id}}', 'recruit', this)" class="ios-switch bigswitch tpl-switch-btn" @if($info->is_send) checked @endif>
                                                <div class="tpl-switch-btn-view">
                                                    <div>
                                                    </div>
                                                </div>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="tpl-table-black-operation">
                                                <a href="/admin/recruit/{{$info->id}}/edit">
                                                    <i class="am-icon-pencil"></i> 编辑
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
                                @if($oInfo)
                                    {!! $oInfo->render('vendor.pagination/default'); !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>