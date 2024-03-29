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
            <a href="/admin/clerk/{{\Illuminate\Support\Facades\Auth::user()->id}}"
               @if(Request::getPathInfo() =='/admin/clerk/'.\Illuminate\Support\Facades\Auth::user()->id)class="active"@endif>
                <i class="am-icon-child sidebar-nav-link-logo"></i> 个人信息
            </a>
        </li>

        <li class="sidebar-nav-link">
            <a href="/admin/my-message" @if(Request::getPathInfo() =='/admin/my-message') class="active" @endif>
                <i class="am-icon-phone sidebar-nav-link-logo"></i> 联系店长
            </a>
        </li>
    </ul>
</div>