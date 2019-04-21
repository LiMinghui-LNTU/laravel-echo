<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="{{asset('assets/i/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('assets/i/app-icon72x72@2x.png')}}">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <script src="{{asset('assets/js/echarts.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/css/amazeui.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/amazeui.datatables.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert2.css')}}"/>
    @if(strpos(Request::getPathInfo(),'calendar'))
        <link rel="stylesheet" href="{{asset('assets/css/fullcalendar.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/css/fullcalendar.print.css')}}" media="print"/>
        <style type="text/css">
            .fc-toolbar{display: none}
        </style>
    @endif
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/ajaxfileupload.js')}}"></script>
    <script src="{{asset('assets/js/admin.js')}}"></script>
    <script src="{{asset('assets/js/DatePicker/WdatePicker.js')}}"></script>
    {{--百度编辑器--}}
    <!-- 配置文件 -->
    <script type="text/javascript" src="{{ asset('assets/ueditor/ueditor.config.js') }}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{ asset('assets/ueditor/ueditor.all.js') }}"></script>
    <!-- 语言包文件(建议手动加载语言包，避免在ie下，因为加载语言失败导致编辑器加载失败) -->
    <script type="text/javascript" src="{{ asset('assets/ueditor/lang/zh-cn/zh-cn.js') }}"></script>

    @if(substr(Request::getPathInfo(), 7) == 'clerk' && !is_null(\App\Model\Designer::getDesignerByUserId(Auth::User()->id)))
        <script>
            window.localStorage.setItem('designer_id', "{{\App\Model\Designer::getDesignerIdByUserId(Auth::User()->id)[0]}}");
        </script>
        <script src="{{asset('js/socket.io.js')}}"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{asset('js/app.js')}}"></script>
    @endif

    @if(strpos(Request::getPathInfo(),'message'))
        <script>
            window.localStorage.setItem('to', '{{Auth::User()->id}}');
            window.localStorage.setItem('type', '{{(\App\User::getRoleById(Auth::User()->id)[0])}}');
        </script>
        <script src="{{asset('js/socket.io.js')}}"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{asset('js/app.js')}}"></script>
    @endif

</head>

<body data-type="index">
<script src="{{asset('assets/js/theme.js')}}"></script>
<div class="am-g tpl-g">
    <!-- 头部 -->
@include('admin.layout.header')
<!-- 风格切换 -->
@include('admin.layout.style')
<!--侧边栏-->
@yield('sidebar')
<!--内容区域-->
    @yield('content')
</div>
</body>
<script src="{{asset('assets/js/moment.js')}}"></script>
<script src="{{asset('assets/js/amazeui.min.js')}}"></script>
<script src="{{asset('assets/js/amazeui.datatables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/fullcalendar.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>

</html>