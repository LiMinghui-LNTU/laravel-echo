<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1,maximum-scale=1.0, user-scalable=0,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/home_logo.ico')}}"/>
    <link rel="bookmark" href="{{asset('assets/img/home_logo.ico')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/amazeui.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert2.css')}}"/>
    @if(strpos(Request::getPathInfo(),'login'))
        <link rel="stylesheet" href="{{asset('assets/css/dlstyle.css')}}"/>
    @endif
    @if(strpos(Request::getPathInfo(),'self'))
        <link rel="stylesheet" href="{{asset('assets/css/fullcalendar.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/css/fullcalendar.print.css')}}" media="print"/>
        <style type="text/css">
            .fc-toolbar{display: none}
        </style>
    @endif
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    {{--<script src="{{asset('assets/js/public.js')}}"></script>--}}
    <script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/ajaxfileupload.js')}}"></script>

    @if(strpos(Request::getPathInfo(),'self'))
        <script>
            window.localStorage.setItem('member_id', '{{\App\Model\Members::getIdByAccount(session()->get('member')[0])[0]}}');
        </script>
        <script src="{{asset('js/socket.io.js')}}"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{asset('js/app.js')}}"></script>
    @endif

    @if(strpos(Request::getPathInfo(),'about'))
        {{--引入百度地图--}}
        <script src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
    @endif

</head>
<body>
<header class="am-topbar header">
    <div class="am-container-1">
        <div class="left hw-logo">
            <img class=" logo" src="{{asset('assets/img/home_logo.png')}}"/>
            <img class="word" src="{{asset('assets/img/hw-word.png')}}"/>
        </div>
        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
                data-am-collapse="{target: '#doc-topbar-collapse'}">
            <span class="am-sr-only">导航切换</span>
            <span class="am-icon-bars"></span>
        </button>
        <?php $oNavigation = \App\Model\Navigation::getAllNavigation();?>
        <div class="am-collapse am-topbar-collapse right" id="doc-topbar-collapse">
            <div class=" am-topbar-left am-form-inline am-topbar-right" role="search">
                <ul class="am-nav am-nav-pills am-topbar-nav hw-menu">
                    @foreach($oNavigation as $navigation)
                        <li @if(strpos(Request::getPathInfo(), $navigation->url) !== false)class="hw-menu-active"@endif>
                            <a href="{{$navigation->url}}">{{$navigation->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</header>
@yield('content')
<footer class="footer ">
    <?php $site_info = \App\Model\SiteInfo::getSiteInfo();?>
    <ul>

        <li class="am-u-lg-4 am-u-md-4 am-u-sm-12 part-5-li2">
            <div class="part-5-title">联系我们</div>
            <div class="part-5-words2">
                <span>地址:{{$site_info->address}}</span>
                <span>手机:{{$site_info->mobile}}</span>
                <span>邮箱:{{$site_info->email}}</span>
                <span>{{$site_info->record_info}}</span>
                <span><i class="am-icon-phone"></i><em>{{$site_info->telephone}}</em></span>
            </div>
        </li>
        <li class="am-u-lg-4 am-u-md-4 am-u-sm-12 ">
            <div class="part-5-title">相关链接</div>
            <div class="part-5-words2">
                <ul class="part-5-words2-ul">
                    @foreach($oNavigation as $navigation)
                        <li class="am-u-lg-4 am-u-md-6 am-u-sm-4"><a
                                    href="{{$navigation->url}}">{{$navigation->name}}</a></li>
                    @endforeach
                    <div class="clear"></div>
                </ul>
            </div>
        </li>
        <li class="am-u-lg-4 am-u-md-4 am-u-sm-12 ">
            <div class="part-5-title">更多信息</div>
            <div class="part-5-words2">
                <ul class="part-5-words2-ul">
                    <li class="am-u-lg-4 am-u-md-6 am-u-sm-4"><img src="{{$site_info->ewm1}}"
                                                                   style="width:130px;height:130px;border:2px #0000ff solid;"/>
                    </li>
                    <li class="am-u-lg-2 am-u-md-6 am-u-sm-4"></li>
                    <li class="am-u-lg-4 am-u-md-6 am-u-sm-4"><img src="{{$site_info->ewm2}}"
                                                                   style="width:130px;height:130px;border:2px #0000ff solid;"/>
                    </li>
                    <div class="clear"></div>
                </ul>
            </div>
        </li>
        <div class="clear"></div>
    </ul>

</footer>


</body>
<!--[if lt IE 9]>
<!--<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>-->
<!--<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>-->
<script src="{{asset('assets/js/amazeui.ie8polyfill.min.js')}}"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->

<!--<![endif]-->
<script src="{{asset('assets/js/public.js')}}"></script>
<script src="{{asset('assets/js/moment.js')}}"></script>
<script src="{{asset('assets/js/amazeui.min.js')}}"></script>
<script src="{{asset('assets/js/fullcalendar.min.js')}}"></script>
<script src="{{asset('assets/js/scroll.js')}}"></script>
</html>