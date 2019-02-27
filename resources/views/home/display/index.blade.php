@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
@section('content')
    <div class="toppic">
        <div class="am-container-1">
            <div class="toppic-title left">
                <i class="am-icon-lightbulb-o toppic-title-i"></i>
                <span class="toppic-title-span">{{$sTitle}}</span>
                <p>Haircut Show</p>
            </div>
            <div class="right toppic-progress">
                <span><a href="/home" class="w-white">首页</a></span>
                <i class=" am-icon-arrow-circle-right w-white"></i>
                <span><a href="/display" class="w-white">{{$sTitle}}</a></span>
            </div>
        </div>
    </div>
    <div data-am-widget="tabs" class="am-tabs am-tabs-d2 ">

        <ul class="am-tabs-nav am-cf solutions-tabs-ul ">
            <li class="am-active solutions-tabs-ul-li1"><a href="[data-tab-panel-0]"><i
                            class=" am-icon-desktop"></i><span>最新流行</span></a></li>
            <li class="solutions-tabs-ul-li2"><a href="[data-tab-panel-1]"><i
                            class=" am-icon-mobile-phone mobile-phone"></i><span>男士风尚</span></a></li>
            <li class="solutions-tabs-ul-li3"><a href="[data-tab-panel-2]"><i
                            class=" am-icon-desktop"></i><span>女性潮流</span></a></li>
            <li class="solutions-tabs-ul-li4"><a href="[data-tab-panel-3]"><i
                            class=" am-icon-mobile-phone mobile-phone"></i><span>优秀作品</span></a></li>
        </ul>

        <div class="am-tabs-bd solutions-tabs-content ">
            <div data-tab-panel-0 class="am-tab-panel am-active">
                <ul class=" solutions-content-ul">
                    @foreach($oCases as $case)
                        @if($case->tag == 1)
                            <li class="am-u-sm-12 am-u-md-6 am-u-lg-12">
                                <a href="javascript:;">
                                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-3 solution-tabs-img">
                                        <img src="{{$case->thumb}}"/>
                                    </div>
                                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9 solution-tabs-words">
                                        <h5>{{$case->title}}</h5>
                                        <p>{!! $case->content !!}</p>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach
                    <div class="clear"></div>
                </ul>
            </div>

            <div data-tab-panel-1 class="am-tab-panel ">
                <ul class="am-container-1 solutions-content-ul">
                    @foreach($oCases as $case)
                        @if($case->tag == 2)
                            <li class="am-u-sm-12 am-u-md-6 am-u-lg-12">
                                <a href="javascript:;">
                                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-3 solution-tabs-img">
                                        <img src="{{$case->thumb}}"/>
                                    </div>
                                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9 solution-tabs-words">
                                        <h5>{{$case->title}}</h5>
                                        <p>{!! $case->content !!}</p>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div data-tab-panel-2 class="am-tab-panel ">
                <ul class="am-container-1 solutions-content-ul">
                    @foreach($oCases as $case)
                        @if($case->tag == 3)
                            <li class="am-u-sm-12 am-u-md-6 am-u-lg-12">
                                <a href="javascript:;">
                                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-3 solution-tabs-img">
                                        <img src="{{$case->thumb}}"/>
                                    </div>
                                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9 solution-tabs-words">
                                        <h5>{{$case->title}}</h5>
                                        <p>{!! $case->content !!}</p>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div data-tab-panel-3 class="am-tab-panel ">
                <ul class="am-container-1 solutions-content-ul">
                    @foreach($oCases as $case)
                        @if($case->tag == 4)
                            <li class="am-u-sm-12 am-u-md-6 am-u-lg-12">
                                <a href="javascript:;">
                                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-3 solution-tabs-img">
                                        <img width="150" height="150" src="{{$case->thumb}}"/>
                                    </div>
                                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9 solution-tabs-words">
                                        <h5>{{$case->title}}</h5>
                                        <p>{!! $case->content !!}</p>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
@endsection