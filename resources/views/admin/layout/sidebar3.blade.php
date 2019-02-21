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
        @if(!is_null(\App\Model\Designer::getDesignerByUserId(\Illuminate\Support\Facades\Auth::user()->id)))
            <li class="sidebar-nav-link">
                <a href="/admin/clerk" @if(Request::getPathInfo() =='/admin/clerk')class="active"@endif>
                    <i class="am-icon-list-alt sidebar-nav-link-logo"></i> 我的订单
                </a>
            </li>
            <li class="sidebar-nav-link">
                <a href="/admin/calendar" @if(Request::getPathInfo() =='/admin/calendar')class="active"@endif>
                    <i class="am-icon-calendar sidebar-nav-link-logo"></i> 日程管理
                </a>
            </li>
        @endif
            <li class="sidebar-nav-link">
                <a href="/admin/clerk/{{\Illuminate\Support\Facades\Auth::user()->id}}" @if(Request::getPathInfo() =='/admin/clerk/'.\Illuminate\Support\Facades\Auth::user()->id)class="active"@endif>
                    <i class="am-icon-child sidebar-nav-link-logo"></i> 个人信息
                </a>
            </li>
        <li class="sidebar-nav-link">
            <a href="javascript:;" class="sidebar-nav-sub-title">
                <i class="am-icon-comments sidebar-nav-link-logo"></i> 消息收发
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
            <a href="tables.html">
                <i class="am-icon-file-text sidebar-nav-link-logo"></i> 登录日志
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="calendar.html">
                <i class="am-icon-phone sidebar-nav-link-logo"></i> 联系店长
            </a>
        </li>
    </ul>
</div>