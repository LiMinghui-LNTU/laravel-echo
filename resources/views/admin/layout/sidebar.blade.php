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
                <i class="am-icon-folder-open sidebar-nav-link-logo"></i> 人员管理
                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
            </a>
            <ul class="sidebar-nav sidebar-nav-sub">
                <li class="sidebar-nav-link">
                    <a href="/admin" @if(Request::getPathInfo() =='/admin')class="active"@endif>
                        <span class="am-icon-male sidebar-nav-link-logo"></span> 人员列表
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="table-list-img.html">
                        <span class="am-icon-user-secret sidebar-nav-link-logo"></span> 角色列表
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:;" class="sidebar-nav-sub-title">
                <i class="am-icon-cogs sidebar-nav-link-logo"></i> 网站设置
                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
            </a>
            <ul class="sidebar-nav sidebar-nav-sub">
                <li class="sidebar-nav-link">
                    <a href="table-list.html">
                        <span class="am-icon-list-ul sidebar-nav-link-logo"></span> 导航栏
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="table-list-img.html">
                        <span class="am-icon-retweet sidebar-nav-link-logo"></span> 首页轮播
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="table-list-img.html">
                        <span class="am-icon-copyright sidebar-nav-link-logo"></span> 版权信息
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:;" class="sidebar-nav-sub-title">
                <i class="am-icon-commenting sidebar-nav-link-logo"></i> 消息收发
                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
            </a>
            <ul class="sidebar-nav sidebar-nav-sub">
                <li class="sidebar-nav-link">
                    <a href="table-list.html">
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
                        <span class="am-icon-file-text sidebar-nav-link-logo"></span> 登录日志
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="table-list.html">
                        <span class="am-icon-wrench sidebar-nav-link-logo"></span> 操作记录
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</div>