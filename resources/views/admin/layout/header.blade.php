<!-- 头部 -->
<header>
    <!-- logo -->
    <div class="am-fl tpl-header-logo">
        <a href="javascript:;"><img src="{{asset('assets/img/logo.png')}}" alt=""></a>
    </div>
    <!-- 右侧内容 -->
    <div class="tpl-header-fluid">
        <!-- 侧边切换 -->
        {{--<div class="am-fl tpl-header-switch-button am-icon-list">--}}
                    {{--<span>--}}

                {{--</span>--}}
        {{--</div>--}}
        <!-- 搜索 -->
        <div class="am-fl tpl-header-search">
            <form class="tpl-header-search-form" action="javascript:;">
                <button class="tpl-header-search-btn am-icon-search"></button>
                <input class="tpl-header-search-box" type="text" placeholder="搜索内容...">
            </form>
        </div>
        <!-- 其它功能-->
        <div class="am-fr tpl-header-navbar">
            <ul>
                <!-- 欢迎语 -->
                <li class="am-text-sm tpl-header-navbar-welcome">
                    <a href="javascript:;">欢迎你, <span>{{Auth::User()->username}}</span> </a>
                </li>

                <!-- 新邮件 -->
                <li class="am-dropdown tpl-dropdown" data-am-dropdown>
                    <a href="javascript:;" class="am-dropdown-toggle tpl-dropdown-toggle" data-am-dropdown-toggle>
                        <i class="am-icon-envelope"></i>
                        <?php $msg_num = \App\Model\Message::getUnreadMsgNum(Auth::User()->id, \App\User::getRoleById(Auth::User()->id)[0]); ?>
                        <span class="am-badge am-badge-success am-round item-feed-badge" id="msg-num">@if($msg_num != 0) {{$msg_num}} @endif</span>
                    </a>
                    <!-- 弹出列表 -->
                    {{--<ul class="am-dropdown-content tpl-dropdown-content">--}}
                        {{--<li class="tpl-dropdown-menu-messages">--}}
                            {{--<a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">--}}
                                {{--<div class="menu-messages-ico">--}}
                                    {{--<img src="{{asset('assets/img/user04.png')}}" alt="">--}}
                                {{--</div>--}}
                                {{--<div class="menu-messages-time">--}}
                                    {{--3小时前--}}
                                {{--</div>--}}
                                {{--<div class="menu-messages-content">--}}
                                    {{--<div class="menu-messages-content-title">--}}
                                        {{--<i class="am-icon-circle-o am-text-success"></i>--}}
                                        {{--<span>夕风色</span>--}}
                                    {{--</div>--}}
                                    {{--<div class="am-text-truncate"> Amaze UI 的诞生，依托于 GitHub 及其他技术社区上一些优秀的资源；Amaze UI--}}
                                        {{--的成长，则离不开用户的支持。--}}
                                    {{--</div>--}}
                                    {{--<div class="menu-messages-content-time">2016-09-21 下午 16:40</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}

                        {{--<li class="tpl-dropdown-menu-messages">--}}
                            {{--<a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">--}}
                                {{--<div class="menu-messages-ico">--}}
                                    {{--<img src="{{asset('assets/img/user02.png')}}" alt="">--}}
                                {{--</div>--}}
                                {{--<div class="menu-messages-time">--}}
                                    {{--5天前--}}
                                {{--</div>--}}
                                {{--<div class="menu-messages-content">--}}
                                    {{--<div class="menu-messages-content-title">--}}
                                        {{--<i class="am-icon-circle-o am-text-warning"></i>--}}
                                        {{--<span>禁言小张</span>--}}
                                    {{--</div>--}}
                                    {{--<div class="am-text-truncate"> 为了能最准确的传达所描述的问题， 建议你在反馈时附上演示，方便我们理解。</div>--}}
                                    {{--<div class="menu-messages-content-time">2016-09-16 上午 09:23</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="tpl-dropdown-menu-messages">--}}
                            {{--<a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">--}}
                                {{--<i class="am-icon-circle-o"></i> 进入列表…--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                </li>

                <!-- 新提示 -->
                <li class="am-dropdown" data-am-dropdown>
                    <a href="javascript:;" class="am-dropdown-toggle" data-am-dropdown-toggle>
                        <i class="am-icon-bell"></i>
                        @if(Auth::User()->role_id == 3 && !is_null(\App\Model\Designer::getDesignerByUserId(Auth::User()->id)))
                            <?php $iNewOrder = \App\Model\Order::searchNewOrderNum(\App\Model\Designer::getDesignerIdByUserId(Auth::User()->id)[0]); ?>
                            <span class="am-badge am-badge-warning am-round item-feed-badge" id="tip_num">@if($iNewOrder != 0){{$iNewOrder}}@endif</span>
                        @else
                            <span class="am-badge am-badge-warning am-round item-feed-badge">5</span>
                        @endif
                    </a>

                    <!-- 弹出列表 -->
                    {{--<ul class="am-dropdown-content tpl-dropdown-content">--}}
                        {{--<li class="tpl-dropdown-menu-notifications">--}}
                            {{--<a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">--}}
                                {{--<div class="tpl-dropdown-menu-notifications-title">--}}
                                    {{--<i class="am-icon-line-chart"></i>--}}
                                    {{--<span> 有6笔新的销售订单</span>--}}
                                {{--</div>--}}
                                {{--<div class="tpl-dropdown-menu-notifications-time">--}}
                                    {{--12分钟前--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="tpl-dropdown-menu-notifications">--}}
                            {{--<a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">--}}
                                {{--<div class="tpl-dropdown-menu-notifications-title">--}}
                                    {{--<i class="am-icon-star"></i>--}}
                                    {{--<span> 有3个来自人事部的消息</span>--}}
                                {{--</div>--}}
                                {{--<div class="tpl-dropdown-menu-notifications-time">--}}
                                    {{--30分钟前--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="tpl-dropdown-menu-notifications">--}}
                            {{--<a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">--}}
                                {{--<div class="tpl-dropdown-menu-notifications-title">--}}
                                    {{--<i class="am-icon-folder-o"></i>--}}
                                    {{--<span> 上午开会记录存档</span>--}}
                                {{--</div>--}}
                                {{--<div class="tpl-dropdown-menu-notifications-time">--}}
                                    {{--1天前--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}


                        {{--<li class="tpl-dropdown-menu-notifications">--}}
                            {{--<a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">--}}
                                {{--<i class="am-icon-bell"></i> 进入列表…--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                </li>

                <!-- 退出 -->
                <li class="am-text-sm">
                    <a href="/admin/logout">
                        <span class="am-icon-sign-out"></span> 退出
                    </a>
                </li>
            </ul>
        </div>
    </div>

</header>