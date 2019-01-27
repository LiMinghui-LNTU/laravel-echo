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
    @if(strpos(Request::getPathInfo(),'clerk'))
        <link rel="stylesheet" href="{{asset('assets/css/fullcalendar.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/css/fullcalendar.print.css')}}" media="print"/>
        <style type="text/css">
            .fc-toolbar{display: none}
        </style>
    @endif
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/admin.js')}}"></script>

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