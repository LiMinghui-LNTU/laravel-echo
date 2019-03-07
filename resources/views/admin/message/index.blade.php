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
                                        <button type="button" class="am-btn am-btn-default am-btn-success"><span
                                                    class="am-icon-plus"></span> 新增
                                        </button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span
                                                    class="am-icon-save"></span> 保存
                                        </button>
                                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span
                                                    class="am-icon-archive"></span> 审核
                                        </button>
                                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span
                                                    class="am-icon-trash-o"></span> 删除
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
            <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search"
                    type="button"></button>
          </span>
                            </div>
                        </div>
                        @csrf
                        <div class="am-u-sm-12" id="people-list">
                            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                <thead>
                                <tr>
                                    <th>发送人</th>
                                    <th>角色</th>
                                    <th>消息内容</th>
                                    <th>发送时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody id="message-list">
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
                                <!-- more data -->
                                </tbody>
                            </table>
                        </div>
                        <div class="am-panel-bd am-u-md-12" id="reply-panel" style="display: none;">
                            <input type="hidden" id="hide-from" value="0">
                            <input type="hidden" id="hide-pre_type" value="0">
                            <ul class="am-comments-list am-comments-list-flip am-scrollable-vertical" id="ul-message">
                            </ul>
                            <hr>
                            <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                <input type="text" id="reply-content" class="am-form-field" placeholder="请输入回复内容：">
                                <span class="am-input-group-btn">
                                    <button class="am-btn  am-btn-default am-btn-danger tpl-table-list-field am-icon-reply" type="button" onclick="reply()">回复</button>
                                    <button class="am-btn  am-btn-default am-btn-primary tpl-table-list-field am-icon-share" type="button" onclick="goBack()">返回</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>