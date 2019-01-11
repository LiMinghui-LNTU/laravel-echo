@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
@section('content')
    <div class="toppic">
        <div class="am-container-1">
            <div class="toppic-title left">
                <i class="am-icon-user toppic-title-i"></i>
                <span class="toppic-title-span">个人中心</span>
                <p>Center</p>
            </div>
            <div class="right toppic-progress">
                <span><a href="/home" class="w-white">首页</a></span>
                <i class=" am-icon-arrow-circle-right w-white"></i>
                <span><a href="/self" class="w-white">个人中心</a></span>
            </div>
        </div>
    </div>

    <div class="login-banner">
        <div class="login-main">
            <div class="login-banner-bg"><span></span><img width=621 src="{{asset('assets/img/hair1.jpg')}}"/></div>
            <div class="login-box">

                <h3 class="title">登录金鹰</h3>

                <div class="clear"></div>

                <div class="login-form">
                    <form>
                        <div class="user-name">
                            <label for="user"><i class="am-icon-user"></i></label>
                            <input type="text" name="" id="user" placeholder="邮箱/手机">
                        </div>
                        <div class="user-pass">
                            <label for="password"><i class="am-icon-lock"></i></label>
                            <input type="password" name="" id="password" placeholder="请输入密码">
                        </div>
                    </form>
                </div>

                <div class="login-links">
                    <label for="remember-me"><input id="remember-me" type="checkbox">记住密码</label>
                    <a href="#" class="am-fr">忘记密码</a>
                    <a href="javascript:void (0);" onclick="doReg()" class="zcnext am-fr am-btn-default">注册</a>
                    <br/>
                </div>
                <div class="am-cf">
                    <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm"
                           onclick="window.location.href='info.html';">
                </div>
                <div class="partner">
                    <h3>合作账号</h3>
                    <div class="am-btn-group">
                        <li><a href="#"><i class="am-icon-qq am-icon-sm"></i><span>QQ登录</span></a></li>
                        <li><a href="#"><i class="am-icon-weibo am-icon-sm"></i><span>微博登录</span> </a></li>
                        <li><a href="#"><i class="am-icon-weixin am-icon-sm"></i><span>微信登录</span> </a></li>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="res-banner" style="display: none;">
        <div class="res-main">
            <div class="login-banner-bg"><span></span><img width=621 src="{{asset('assets/img/hair1.jpg')}}"/></div>
            <div class="login-box">
                <div class="am-tabs" id="doc-my-tabs">
                    <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
                        <li class="am-active"><a href="">邮箱注册</a></li>
                        <li><a href="">手机号注册</a></li>
                    </ul>
                    <div class="am-tabs-bd">
                        <div class="am-tab-panel am-active">
                            <form id="email-reg" method="post" action="">

                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="reg-type" value="1">
                                <div class="user-email">
                                    <label for="email"><i class="am-icon-envelope-o"></i></label>
                                    <input type="email" name="account-email" id="account-email" placeholder="请输入邮箱账号">
                                </div>
                                <div class="user-pass">
                                    <label for="password"><i class="am-icon-lock"></i></label>
                                    <input type="password" name="password-email" id="password-email" placeholder="设置密码">
                                </div>
                                <div class="user-pass">
                                    <label for="passwordRepeat"><i class="am-icon-shield"></i></label>
                                    <input type="password" name="re-password-email" id="re-password-email"
                                           placeholder="确认密码">
                                </div>

                            </form>

                            <div class="login-links">
                                <label for="reader-me">
                                    <input name="reader-me" type="checkbox" required> 同意金鹰发艺平台《服务协议》
                                </label>
                            </div>
                            <div class="am-cf">
                                <input type="button" id="reg-email-btn" value="注册"
                                       class="am-btn am-btn-primary am-btn-sm am-fl">
                            </div>

                        </div>

                        <div class="am-tab-panel">
                            <form id="phone-reg" method="post" action="">

                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="reg-type" value="2">
                                <div class="user-phone">
                                    <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
                                    <input type="tel" name="phone_number" id="phone_number" placeholder="请输入手机号">
                                </div>
                                <div class="verification">
                                    <label for="code"><i class="am-icon-code-fork"></i></label>
                                    <input type="tel" name="check_code" id="check_code" placeholder="请输入验证码">
                                    <button class="btn" id="sendMobileCode">
                                        <span id="dyMobileButton">获取</span>
                                    </button>
                                </div>
                                <div class="user-pass">
                                    <label for="password"><i class="am-icon-lock"></i></label>
                                    <input type="password" name="password-phone" id="password-phone" placeholder="设置密码">
                                </div>
                                <div class="user-pass">
                                    <label for="passwordRepeat"><i class="am-icon-shield"></i></label>
                                    <input type="password" name="re-password-phone" id="re-password-phone"
                                           placeholder="确认密码">
                                </div>
                            </form>
                            <div class="login-links">
                                <label for="reader-me">
                                    <input name="reader-me" type="checkbox" required> 同意金鹰发艺平台《服务协议》
                                </label>
                            </div>
                            <div class="am-cf">
                                <input type="button" id="reg-phone-btn" name="reg-phone-btn" value="注册"
                                       class="am-btn am-btn-primary am-btn-sm am-fl">
                            </div>

                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection