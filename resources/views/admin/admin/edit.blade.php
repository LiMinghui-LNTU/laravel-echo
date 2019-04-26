<div class="tpl-content-wrapper">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">{{$sTitle}}</div>
                    <div class="widget-function am-fr">
                        <a href="javascript:;" class="am-icon-cog"></a>
                    </div>
                </div>
                @include('admin.common.error')
                <div class="widget-body am-fr">

                    <form action="/admin/{{$oUser->id}}" class="am-form tpl-form-border-form" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="am-form-group">
                            <label for="username" class="am-u-sm-12 am-form-label am-text-left">
                                用户名
                                <span class="tpl-form-line-small-title">Username</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="text" class="tpl-form-input am-margin-top-xs" id="username" name="username" value="{{$oUser->username}}" placeholder="请输入用户名" required>
                                <small>作为后台登录用户名。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="password" class="am-u-sm-12 am-form-label am-text-left">
                                密码
                                <span class="tpl-form-line-small-title">Password</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="password" class="tpl-form-input am-margin-top-xs" id="password" name="password" value="{{$oUser->password}}" placeholder="******" required>
                                <small>作为后台登录密码。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="gander" class="am-u-sm-12 am-form-label am-text-left">
                                角色
                                <span class="tpl-form-line-small-title">Role</span>
                            </label>
                            <div class="am-u-sm-12">
                                <label class="am-radio-inline">
                                    <input type="radio" name="role_id" value="1" @if($oUser->role_id == 1) checked @endif required data-am-ucheck>管理员
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="role_id" value="2" @if($oUser->role_id == 2) checked @endif  required data-am-ucheck>店长
                                </label>
                                <br>
                                <small>分配管理者角色。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="email" class="am-u-sm-12 am-form-label am-text-left">
                                邮箱
                                <span class="tpl-form-line-small-title">Email</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="email" name="email" class="am-form-field tpl-form-no-bg am-margin-top-xs" value="{{$oUser->email}}" placeholder="请输入邮箱">
                                <small>非必填。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="phone" class="am-u-sm-12 am-form-label am-text-left">
                                电话
                                <span class="tpl-form-line-small-title">Phone</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="number" name="phone" class="am-form-field tpl-form-no-bg am-margin-top-xs" value="{{$oUser->phone}}" placeholder="请输入电话">
                                <small>非必填。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <div class="am-u-sm-12 am-u-sm-push-12">
                                <input type="submit" class="am-btn am-btn-success tpl-btn-bg-color-success" value="保存">
                                <input type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success" value="退出" onclick="window.history.go(-1);">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>