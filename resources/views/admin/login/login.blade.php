<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>金鹰后台登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="{{asset('assets/i/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('assets/i/app-icon72x72@2x.png')}}">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <link rel="stylesheet" href="{{asset('assets/css/amazeui.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/amazeui.datatables.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

</head>

<body data-type="login">
<script src="{{asset('assets/js/theme.js')}}"></script>
<div class="am-g tpl-g">
    <!-- 风格切换 -->
    <div class="tpl-skiner">
        <div class="tpl-skiner-toggle am-icon-cog">
        </div>
        <div class="tpl-skiner-content">
            <div class="tpl-skiner-content-title">
                选择主题
            </div>
            <div class="tpl-skiner-content-bar">
                <span class="skiner-color skiner-white" data-color="theme-white"></span>
                <span class="skiner-color skiner-black" data-color="theme-black"></span>
            </div>
        </div>
    </div>
    <div class="tpl-login">
        <div class="tpl-login-content">
            <div class="tpl-login-logo">

            </div>

            @include('admin.common.warning')
            @include('admin.common.error')
            <form class="am-form tpl-form-line-form" action="/admin/login" method="post">
                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                <div class="am-form-group">
                    <input type="text" class="tpl-form-input" name="username" id="username" placeholder="请输入账号"
                           value="{{old('username')}}">

                </div>

                <div class="am-form-group">
                    <input type="password" class="tpl-form-input" name="password" id="password" placeholder="请输入密码"
                           value="{{old('password')}}">

                </div>
                <div class="am-form-group tpl-login-remember-me">
                    @foreach($oRole as $role)
                        <input id="remember-me{{$role->id}}" type="radio" name="role" value="{{$role->id}}">
                        <label for="remember-me{{$role->id}}">

                            {{$role->name}}
                        </label>
                    @endforeach
                </div>
                <div class="am-form-group">

                    <button type="submit"
                            class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">提交
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/amazeui.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>

</body>

</html>