<div class="left-sidebar">
    <!-- 用户信息 -->
    <div class="tpl-sidebar-user-panel">
        <div class="tpl-user-panel-slide-toggleable">
            <div class="tpl-user-panel-profile-picture">
                <img src="{{Auth::User()->head_url}}" alt="">
            </div>
            <span class="user-panel-logged-in-text">
              <i class="am-icon-user am-text-success tpl-user-panel-status-icon"></i>
                {{Auth::User()->username}}
          </span>
            <a href="javascript:;" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 账号设置</a>
        </div>
    </div>

    <!-- 菜单 -->
    <ul class="sidebar-nav">
        <li class="sidebar-nav-link">
            <a href="javascript:;" class="sidebar-nav-sub-title">
                <i class="am-icon-users sidebar-nav-link-logo"></i> 我的员工
                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
            </a>
            <ul class="sidebar-nav sidebar-nav-sub">
                <li class="sidebar-nav-link">
                    <a href="/admin/shopowner" @if(Request::getPathInfo() =='/admin/shopowner')class="active"@endif>
                        <span class="am-icon-table sidebar-nav-link-logo"></span> 员工列表
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="table-list-img.html">
                        <span class="am-icon-street-view sidebar-nav-link-logo"></span> 应聘申请
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:;" class="sidebar-nav-sub-title">
                <i class="am-icon-gear sidebar-nav-link-logo"></i> 网站设置
                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
            </a>
            <ul class="sidebar-nav sidebar-nav-sub">
                <li class="sidebar-nav-link">
                    <a href="table-list-img.html">
                        <span class="am-icon-image sidebar-nav-link-logo"></span> 首页轮播
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="/admin/case-show">
                        <span class="am-icon-book sidebar-nav-link-logo"></span> 发型展示
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="table-list.html">
                        <span class="am-icon-ticket sidebar-nav-link-logo"></span> 优惠活动
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="table-list.html">
                        <span class="am-icon-cc-discover sidebar-nav-link-logo"></span> 会员机制
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="table-list.html">
                        <span class="am-icon-newspaper-o sidebar-nav-link-logo"></span> 招聘广告
                    </a>
                </li>
            </ul>
        </li>
        {{--<li class="sidebar-nav-link">--}}
            {{--<a href="javascript:;" class="sidebar-nav-sub-title">--}}
                {{--<i class="am-icon-child sidebar-nav-link-logo"></i> 我的顾客--}}
                {{--<span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>--}}
            {{--</a>--}}
            {{--<ul class="sidebar-nav sidebar-nav-sub">--}}
                {{--<li class="sidebar-nav-link">--}}
                    {{--<a href="table-list.html">--}}
                        {{--<span class="am-icon-list-ol sidebar-nav-link-logo"></span> 顾客列表--}}
                    {{--</a>--}}
                {{--</li>--}}

                {{--<li class="sidebar-nav-link">--}}
                    {{--<a href="table-list-img.html">--}}
                        {{--<span class="am-icon-tags sidebar-nav-link-logo"></span> 预约列表--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</li>--}}
        <li class="sidebar-nav-link">
            <a href="javascript:;" class="sidebar-nav-sub-title">
                <i class="am-icon-comments sidebar-nav-link-logo"></i> 消息收发
                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
            </a>
            <ul class="sidebar-nav sidebar-nav-sub">
                <li class="sidebar-nav-link">
                    <a href="/admin/message-list">
                        <span class="am-icon-download sidebar-nav-link-logo"></span> 收消息
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="table-list-img.html">
                        <span class="am-icon-upload sidebar-nav-link-logo"></span> 发消息
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="table-list-img.html">
                        <span class="am-icon-bookmark sidebar-nav-link-logo"></span> 待办事项
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:;" class="sidebar-nav-sub-title">
                <i class="am-icon-calculator sidebar-nav-link-logo"></i> 数据统计
                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
            </a>
            <ul class="sidebar-nav sidebar-nav-sub">
                <li class="sidebar-nav-link">
                    <a href="table-list-img.html">
                        <span class="am-icon-file-text sidebar-nav-link-logo"></span> 注册日志
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="table-list.html">
                        <span class="am-icon-paypal sidebar-nav-link-logo"></span> 消费记录
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="table-list.html">
                        <span class="am-icon-bar-chart sidebar-nav-link-logo"></span> 员工业绩
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="table-list-img.html">
                        <span class="am-icon-rmb sidebar-nav-link-logo"></span> 我的收入
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-nav-link">
            <a href="chart.html">
                <i class="am-icon-phone sidebar-nav-link-logo"></i> 联系管理员
            </a>
        </li>

    </ul>
</div>