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
                                <tbody>
                                <tr class="gradeX">
                                    <td>
                                        <span class="am-badge am-badge-primary am-round">4</span>
                                        包子入侵
                                    </td>
                                    <td>顾客</td>
                                    <td>店长你好，我想办理会员，请问如何操作？</td>
                                    <td>2819-01-20 19:36:45</td>
                                    <td>
                                        <div class="tpl-table-black-operation">
                                            <a href="javascript:getMessage({{'1'}});">
                                                <i class="am-icon-pencil"></i> 回复
                                            </a>
                                            <a href="javascript:;" class="tpl-table-black-operation-del">
                                                <i class="am-icon-trash"></i> 禁言
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <!-- more data -->
                                </tbody>
                            </table>
                        </div>
                        <div class="am-u-lg-12 am-cf" id="paginate-nav">
                            <div class="am-fr">
                                <ul class="am-pagination tpl-pagination">
                                    <li class="am-disabled"><a href="#">«</a></li>
                                    <li class="am-active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">»</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="am-panel-bd am-u-md-12" id="reply-panel" style="display: none;">
                            <ul class="am-comments-list am-comments-list-flip am-scrollable-vertical">
                                <li class="am-comment am-comment-primary">
                                    <a href="#link-to-user-home">
                                        <img src="http://www.gravatar.com/avatar/1ecedeede84abbf371b9d8d656bb4265?d=mm&amp;s=96"
                                             alt="" class="am-comment-avatar" width="48" height="48">
                                    </a>
                                    <div class="am-comment-main">
                                        <header class="am-comment-hd">
                                            <div class="am-comment-meta">
                                                <a href="#link-to-user" class="am-comment-author">路人乙</a> 评论于
                                                <time datetime="2013-07-27T04:54:29-07:00"
                                                      title="2013年7月27日 下午7:54 格林尼治标准时间+0800">2014-7-14 23:30
                                                </time>
                                            </div>
                                        </header>
                                        <div class="am-comment-bd">
                                            <p><a href="#lin-to-user">@某人</a> 撸主保重！</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="am-comment am-comment-flip am-comment-secondary">
                                    <a href="#link-to-user-home">
                                        <img src="http://s.amazeui.org/media/i/demos/bw-2014-06-19.jpg?imageView/1/w/96/h/96"
                                             alt="" class="am-comment-avatar" width="48" height="48">
                                    </a>
                                    <div class="am-comment-main">
                                        <header class="am-comment-hd">
                                            <div class="am-comment-meta">
                                                <a href="#link-to-user" class="am-comment-author">某人</a> 评论于
                                                <time datetime="2013-07-27T04:54:29-07:00"
                                                      title="2013年7月27日 下午7:54 格林尼治标准时间+0800">2014-7-14 23:301
                                                </time>
                                            </div>
                                        </header>
                                        <div class="am-comment-bd">
                                            <p><a href="#lurenyi">@路人乙</a> 朕知道了！</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="am-comment am-comment-highlight">
                                    <a href="#link-to-user-home">
                                        <img src="http://www.gravatar.com/avatar/1ecedeede84abbf371b9d8d656bb4265?d=mm&amp;s=96"
                                             alt="" class="am-comment-avatar" width="48" height="48">
                                    </a>
                                    <div class="am-comment-main">
                                        <header class="am-comment-hd">
                                            <div class="am-comment-meta">
                                                <a href="#link-to-user" class="am-comment-author">路人乙</a> 评论于
                                                <time datetime="2013-07-27T04:54:29-07:00"
                                                      title="2013年7月27日 下午7:54 格林尼治标准时间+0800">2014-7-14 23:32
                                                </time>
                                            </div>
                                        </header>
                                        <div class="am-comment-bd">
                                            <p><a href="#lin-to-user">@某人</a> 艹民告退！</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="am-comment am-comment-flip am-comment-danger">
                                    <a href="#link-to-user-home">
                                        <img src="http://s.amazeui.org/media/i/demos/bw-2014-06-19.jpg?imageView/1/w/96/h/96"
                                             alt="" class="am-comment-avatar" width="48" height="48">
                                    </a>
                                    <div class="am-comment-main">
                                        <header class="am-comment-hd">
                                            <div class="am-comment-meta">
                                                <a href="#link-to-user" class="am-comment-author">某人</a> 评论于
                                                <time datetime="2013-07-27T04:54:29-07:00"
                                                      title="2013年7月27日 下午7:54 格林尼治标准时间+0800">2014-7-14 23:301
                                                </time>
                                            </div>
                                        </header>
                                        <div class="am-comment-bd"><p><a href="#lurenyi">@路人乙</a> 滚！</p></div>
                                    </div>
                                </li>
                                <li class="am-comment am-comment-warning"><a href="#link-to-user-home"><img
                                                src="http://www.gravatar.com/avatar/1ecedeede84abbf371b9d8d656bb4265?d=mm&amp;s=96"
                                                alt="" class="am-comment-avatar" width="48" height="48"></a>
                                    <div class="am-comment-main">
                                        <header class="am-comment-hd">
                                            <div class="am-comment-meta"><a href="#link-to-user"
                                                                            class="am-comment-author">路人乙</a> 评论于
                                                <time datetime="2013-07-27T04:54:29-07:00"
                                                      title="2013年7月27日 下午7:54 格林尼治标准时间+0800">2014-7-14 23:32
                                                </time>
                                            </div>
                                        </header>
                                        <div class="am-comment-bd"><p><a href="#lin-to-user">@某人</a> 你妹！</p></div>
                                    </div>
                                </li>
                                <li class="am-comment am-comment-flip am-comment-success"><a
                                            href="#link-to-user-home"><img
                                                src="http://s.amazeui.org/media/i/demos/bw-2014-06-19.jpg?imageView/1/w/96/h/96"
                                                alt="" class="am-comment-avatar" width="48" height="48"></a>
                                    <div class="am-comment-main">
                                        <header class="am-comment-hd">
                                            <div class="am-comment-meta"><a href="#link-to-user"
                                                                            class="am-comment-author">某人</a> 评论于
                                                <time datetime="2013-07-27T04:54:29-07:00"
                                                      title="2013年7月27日 下午7:54 格林尼治标准时间+0800">2014-7-14 23:301
                                                </time>
                                            </div>
                                        </header>
                                        <div class="am-comment-bd"><p><a href="#lurenyi">@路人乙</a> 你妹你妹！</p></div>
                                    </div>
                                </li>
                            </ul>
                            <hr>
                            <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                <input type="text" class="am-form-field ">
                                <span class="am-input-group-btn">
                                    <button class="am-btn  am-btn-default am-btn-danger tpl-table-list-field am-icon-reply" type="button">回复</button>
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