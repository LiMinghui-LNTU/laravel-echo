@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
@section('content')
    <div class="toppic">
        <div class="am-container-1">
            <div class="toppic-title left">
                <i class="am-icon-dropbox toppic-title-i"></i>
                <span class="toppic-title-span">{{$sTitle}}</span>
                <p>Designer Team</p>
            </div>
            <div class="right toppic-progress">
                <span><a href="/home" class="w-white">首页</a></span>
                <i class=" am-icon-arrow-circle-right w-white"></i>
                <span><a href="/designer" class="w-white">{{$sTitle}}</a></span>
            </div>
        </div>
    </div>

    <div>
        <ul class="product-show-ul">
            <?php $i = 0; ?>
            @foreach($oDesigners as $designer)
                <?php $i++; ?>
                @if($i % 2 == 1)
                    <li>
                        <div class="product-content">
                            <div class="left am-u-sm-12 am-u-md-6 am-u-lg-6 product-content-left">
                                <div class="product-show-title">
                                    <h3>{{$designer->name}}</h3>
                                    @if($designer->sex == 1)
                                        <span class="am-icon-mars am-icon-sm"></span>
                                    @else
                                        <span class="am-icon-venus am-icon-sm"></span>
                                    @endif
                                    <span>{{$designer->title}}</span>
                                </div>

                                <div class="product-show-content">
                                    <div class="product-add">
                                        <span>人气指数：</span>
                                        <div>
                                            @for($j = 0; $j < $designer->stars; $j++)
                                                <span class="am-icon-star am-icon-sm"></span>
                                            @endfor
                                        </div>
                                        <i class="am-icon-dribbble"></i>
                                    </div>
                                    <div class="product-intro">
                                        <span>个人简介：</span>
                                        <div>
                                            <p>
                                                {{$designer->introduction}}
                                            </p>
                                        </div>
                                        <i class="am-icon-tasks"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="right am-u-sm-12 am-u-md-6 am-u-lg-6 product-content-right">
                                <img class="product-img" src="{{$designer->photo}}"/>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </li>
                @else
                    <li class="gray-li">
                        <div class="product-content">
                            <div class="left am-u-sm-12 am-u-md-6 am-u-lg-6 product-content-left">
                                <img class="product-img" src="{{$designer->photo}}"/>

                            </div>
                            <div class="right am-u-sm-12 am-u-md-6 am-u-lg-6 product-content-right">
                                <div class="product-show-title">
                                    <h3>{{$designer->name}}</h3>
                                    @if($designer->sex == 1)
                                        <span class="am-icon-mars am-icon-sm"></span>
                                    @else
                                        <span class="am-icon-venus am-icon-sm"></span>
                                    @endif
                                    <span>{{$designer->title}}</span>
                                </div>

                                <div class="product-show-content">
                                    <div class="product-add">
                                        <span>人气指数：</span>
                                        <div>
                                            @for($j = 0; $j < $designer->stars; $j++)
                                                <span class="am-icon-star am-icon-sm"></span>
                                            @endfor
                                        </div>
                                        <i class="am-icon-dribbble"></i>
                                    </div>
                                    <div class="product-intro">
                                        <span>个人简介：</span>
                                        <div>
                                            <p>
                                                {{$designer->introduction}}
                                            </p>
                                        </div>
                                        <i class="am-icon-tasks"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </li>
                @endif
            @endforeach
            <div class="clear"></div>
        </ul>
    </div>
@endsection