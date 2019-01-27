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

                    <form action="/admin/shopowner" class="am-form tpl-form-border-form" method="post">
                        @csrf
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">
                                用户名
                                <span class="tpl-form-line-small-title">Username</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="text" class="tpl-form-input am-margin-top-xs" id="user-name" name="username" value="{{old('username')}}" placeholder="请输入用户名" required>
                                <small>此用户名用于后台登录。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-password" class="am-u-sm-12 am-form-label am-text-left">
                                设置密码
                                <span class="tpl-form-line-small-title">Password</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="password" name="password" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请设置密码" required>
                                <small>该密码用于后台登录。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-12 am-form-label am-text-left">
                                电子邮箱
                                <span class="tpl-form-line-small-title">Email</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="email" name="email" value="{{old('email')}}" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请填写邮箱">
                                <small>非必填，登录后可自行更改。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-12 am-form-label am-text-left">
                                联系电话
                                <span class="tpl-form-line-small-title">Phone</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="number" name="phone" value="{{old('phone')}}" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请填写联系电话">
                                <small>非必填，登录后可自行更改。</small>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-u-sm-12 am-u-sm-push-12">
                                <input type="submit" class="am-btn am-btn-success tpl-btn-bg-color-success ">
                                <input type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success" value="返回" onclick="window.location.href='/admin/shopowner';">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>