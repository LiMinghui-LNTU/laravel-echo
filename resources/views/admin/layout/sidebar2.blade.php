<div class="left-sidebar">
    @csrf
    <!-- 用户信息 -->
    <div class="tpl-sidebar-user-panel">
        <div class="tpl-user-panel-slide-toggleable">
            <div class="tpl-user-panel-profile-picture">
                <img id="user-head-img" class="user-head-img" src="{{Auth::User()->head_url}}" alt="">
            </div>
            <span class="photo-upload"> <i class="am-icon-upload">上传</i> </span>
            <span class="user-panel-logged-in-text">
              <i class="am-icon-user am-text-success tpl-user-panel-status-icon"></i>
                <span class="username-input">{{Auth::User()->username}}</span> <i class="username-icon-edit am-icon-edit am-text-primary tpl-user-panel-status-icon"></i> <i class="username-icon-check am-icon-check am-text-success tpl-user-panel-status-icon"></i> <i class="username-icon-close am-icon-close am-text-danger tpl-user-panel-status-icon"></i>
          </span>
            <span class="password-icon-edit tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 修改密码</span>
        </div>
    </div>

    <!-- 菜单 -->
    <ul class="sidebar-nav">
        <li class="sidebar-nav-link">
            <a href="/admin/shopowner" @if(Request::getPathInfo() =='/admin/shopowner')class="active"@endif>
                <span class="am-icon-table sidebar-nav-link-logo"></span> 员工列表
            </a>
        </li>

        <li class="sidebar-nav-link">
            <a href="/admin/message" @if(Request::getPathInfo() =='/admin/message')class="active"@endif>
                <span class="am-icon-comments sidebar-nav-link-logo"></span> 我的消息
            </a>
        </li>

        <li class="sidebar-nav-link">
            <a href="javascript:;" class="sidebar-nav-sub-title">
                <i class="am-icon-gear sidebar-nav-link-logo"></i> 网站设置
                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
            </a>
            <ul class="sidebar-nav sidebar-nav-sub">
                <li class="sidebar-nav-link">
                    <a href="/admin/service" @if(Request::getPathInfo() =='/admin/service')class="active"@endif>
                        <span class="am-icon-server sidebar-nav-link-logo"></span> 店铺服务
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="/admin/sowmap" @if(Request::getPathInfo() =='/admin/sowmap')class="active"@endif>
                        <span class="am-icon-image sidebar-nav-link-logo"></span> 首页轮播
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="/admin/case" @if(Request::getPathInfo() =='/admin/case')class="active"@endif>
                        <span class="am-icon-book sidebar-nav-link-logo"></span> 发型展示
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="/admin/article" @if(Request::getPathInfo() =='/admin/article')class="active"@endif>
                        <span class="am-icon-pencil sidebar-nav-link-logo"></span> 养护文章
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="/admin/ticket" @if(Request::getPathInfo() =='/admin/ticket')class="active"@endif>
                        <span class="am-icon-ticket sidebar-nav-link-logo"></span> 优惠活动
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="/admin/vip" @if(Request::getPathInfo() =='/admin/vip')class="active"@endif>
                        <span class="am-icon-cc-discover sidebar-nav-link-logo"></span> 会员机制
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="/admin/recruit" @if(Request::getPathInfo() =='/admin/recruit')class="active"@endif>
                        <span class="am-icon-newspaper-o sidebar-nav-link-logo"></span> 招聘广告
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
                    <a href="/admin/customer" @if(Request::getPathInfo() =='/admin/customer')class="active"@endif>
                        <span class="am-icon-child sidebar-nav-link-logo"></span> 我的顾客
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="table-list-img.html">
                        <span class="am-icon-file-text sidebar-nav-link-logo"></span> 注册日志
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="/admin/achievement-statistic">
                        <span class="am-icon-bar-chart sidebar-nav-link-logo"></span> 员工业绩
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="/admin/visitors-num">
                        <span class="am-icon-rmb sidebar-nav-link-logo"></span> 月访客量
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</div>